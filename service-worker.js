const CACHE_NAME = "kitcat-v3";

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
    caches.open(CACHE_NAME).then((cache) => {
      return cache.addAll(ASSETS);
    })
  );
  self.skipWaiting();
});

// Activate
self.addEventListener("activate", (e) => {
  e.waitUntil(self.clients.claim());
  console.log("Service Worker Activated");
});

// Fetch (cache first)
self.addEventListener("fetch", (e) => {
  e.respondWith(
    caches.match(e.request).then((res) => {
      return res || fetch(e.request);
    })
  );
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