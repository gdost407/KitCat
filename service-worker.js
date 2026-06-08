// const CACHE_NAME = "kitcat-v6";
const CACHE_STATIC = "kitcat-static-v9";
const CACHE_DYNAMIC = "kitcat-dynamic-v9";

const SCOPE_URL = new URL(self.registration.scope);
const INDEX_URL = new URL("index.html", SCOPE_URL).href;
const ASSETS = [
  SCOPE_URL.href,
  INDEX_URL,
  new URL("manifest.json", SCOPE_URL).href,
  new URL("assets/KitCat-Logo.jpg", SCOPE_URL).href,
  new URL("assets/KitCat-bg.png", SCOPE_URL).href
];

const clientActiveChats = new Map();

// Install
self.addEventListener("install", (e) => {
  e.waitUntil(
    caches.open(CACHE_STATIC).then((cache) => {
      return cache.addAll(ASSETS);
    })
  );
  self.skipWaiting();
});

// Activate
self.addEventListener("activate", (e) => {
  e.waitUntil(
    caches.keys().then((names) => {
      return Promise.all(
        names.map((name) => {
          if (name !== CACHE_STATIC && name !== CACHE_DYNAMIC) {
            return caches.delete(name);
          }
        })
      );
    }).then(() => self.clients.claim())
  );
});

// Fetch fresh files first, then fall back to cache when offline.
self.addEventListener("fetch", (e) => {
  if (e.request.method !== "GET") return;
  const url = new URL(e.request.url);
  if (url.origin !== location.origin) return;
  if (e.request.mode === "navigate") {
    e.respondWith(
      fetch(e.request)
        .then((response) => {
          const copy = response.clone();
          caches.open(CACHE_STATIC).then((cache) => {
            cache.put(INDEX_URL, copy);
          });
          return response;
        })
        .catch(() => {
          return caches.match(INDEX_URL);
        })
    );
    return;
  }

  if (ASSETS.includes(e.request.url)) {
    e.respondWith(
      caches.match(e.request).then((cached) => {
        return cached || fetch(e.request);
      })
    );
    return;
  }

  e.respondWith(
    fetch(e.request)
      .then((res) => {
        const copy = res.clone();
        caches.open(CACHE_DYNAMIC).then((cache) => {
          cache.put(e.request, copy);
        });
        return res;
      })
      .catch(() => {
        return caches.match(e.request);
      })
  );
});

self.addEventListener("message", (event) => {
  if (event.data && event.data.type === "SKIP_WAITING") {
    self.skipWaiting();
  }

  if (event.data && event.data.type === "ACTIVE_CHAT" && event.source?.id) {
    clientActiveChats.set(event.source.id, String(event.data.chatId || ""));
  }
});

// Push Notifications
self.addEventListener("push", (event) => {

  let data = {};

  try {
    const payload = event.data.json();
    data = payload.data || payload;
  } catch (e) {
    data = {
      title: "KitCat",
      body: "New Message",
    };
  }

  const title = data.title || "KitCat";
  const body  = data.body || "You received a message";
  const chatId = String(data.chatId || "");

  const options = {
    body: body,
    icon: new URL("assets/KitCat-Logo.jpg", SCOPE_URL).href,
    badge: new URL("assets/KitCat-Logo.jpg", SCOPE_URL).href,
    vibrate: [200, 100, 200],
    tag: chatId || "kitcat-chat",
    data: {
      chatId: chatId,
      click_action: SCOPE_URL.href
    }
  };

  event.waitUntil(
    clients.matchAll({
      type: "window",
      includeUncontrolled: true
    }).then((clientList) => {
      const isChatOpen = clientList.some((client) => {
        const activeChatId = clientActiveChats.get(client.id) || "";
        const isActiveWindow = client.focused || client.visibilityState === "visible";
        return chatId && activeChatId === chatId && isActiveWindow;
      });

      if (isChatOpen) {
        return;
      }

      return self.registration.showNotification(title, options);
    })
  );
});

// Notification Click
self.addEventListener("notificationclick", (event) => {

  event.notification.close();

  const chatId = event.notification.data.chatId;

  event.waitUntil(
    clients.matchAll({
      type: "window",
      includeUncontrolled: true
    }).then((clientList) => {

      for (const client of clientList) {
        if ("focus" in client) {
          client.postMessage({
            type: "OPEN_CHAT",
            chatId: chatId
          });
          return client.focus();
        }
      }

      return clients.openWindow(new URL("./?chatId=" + encodeURIComponent(chatId), SCOPE_URL).href);
    })
  );
});
