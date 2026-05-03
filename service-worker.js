const CACHE_NAME = "kitcat-v5";

const ASSETS = [
  "/",
  "/index.html",
  "/manifest.json",
  "/assets/KitCat-Logo.jpg",
  "/assets/KitCat-bg.png"
];

// Install
self.addEventListener("install", (e) => {
  e.waitUntil(
    caches.open(CACHE_NAME).then(async(cache) => {
      for (const asset of ASSETS) {
        await cache.add(new Request(asset, { cache: "reload" }));
      }
    })
  );
});

// Activate
self.addEventListener("activate", (e) => {
  e.waitUntil(
    caches.keys().then((names) => {
      return Promise.all(
        names
          .filter((name) => name !== CACHE_NAME)
          .map((name) => caches.delete(name))
      );
    }).then(() => self.clients.claim())
  );
  console.log("Service Worker Activated");
});

// Fetch fresh files first, then fall back to cache when offline.
self.addEventListener("fetch", (e) => {
  if (e.request.method !== "GET") return;

  const url = new URL(e.request.url);
  if (url.origin !== location.origin) return;

  e.respondWith(
    fetch(new Request(e.request, { cache: "no-store" }))
      .then((res) => {
        const copy = res.clone();
        caches.open(CACHE_NAME).then((cache) => cache.put(e.request, copy));
        return res;
      })
      .catch(() => {
        if (e.request.mode === "navigate") {
          return caches.match("/index.html");
        }
        return caches.match(e.request);
      })
  );
});

self.addEventListener("message", (event) => {
  if (event.data && event.data.type === "SKIP_WAITING") {
    self.skipWaiting();
  }
});

// Push Notifications
self.addEventListener("push", (event) => {

  let data = {};

  try {
    data = event.data.json();
  } catch (e) {
    data = {
      title: "KitCat",
      body: "New Message",
    };
  }

  const title = data.title || "KitCat";
  const body  = data.body || "You received a message";

  const options = {
    body: body,
    icon: "/assets/KitCat-Logo.jpg",
    badge: "/assets/KitCat-Logo.jpg",
    vibrate: [200, 100, 200],
    tag: data.chatId || "kitcat-chat",
    data: {
      chatId: data.chatId || "",
      click_action: "/"
    }
  };

  event.waitUntil(
    self.registration.showNotification(title, options)
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

      return clients.openWindow("/?chatId=" + chatId);
    })
  );
});
