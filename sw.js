const CACHE_KEY = "hnphp-v1";

self.addEventListener("install", function(event) {

  event.waitUntil(
    caches
      .open(CACHE_KEY)
      .then(function(cache) {
       
        return cache.addAll([
          '/'
        ]);
      })
      .then(function() {
        console.log('WORKER: install completed');
      })
      .catch(function() {
        console.log("ERROR", arguments);
      })
  );
});

self.addEventListener('fetch', function(event) {
  
  event.respondWith(
    caches.open(CACHE_KEY).then(function(cache) {
      return fetch(event.request).then(function(response) {
        if (response.status == 200) {
          cache.put(event.request, response.clone());
        }
        else {
          console.log("Server returned error", response);
        }
        return response;
      }).catch(function(error) {
        return cache.match(event.request).then(function(response) {
          return response;
        })
      });
    })
  );
  
});

