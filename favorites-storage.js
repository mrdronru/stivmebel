/* favorites-storage.js — загружается в <head>, до любых inline-скриптов */
(function() {
  var LS_KEY = 'stiv_favorites';

  window.favStorage = {
    load: function() {
      try { return new Set(JSON.parse(localStorage.getItem(LS_KEY)) || []); }
      catch(e) { return new Set(); }
    },
    save: function(set) {
      try { localStorage.setItem(LS_KEY, JSON.stringify(Array.from(set))); } catch(e) {}
    },
    add: function(img) {
      var s = this.load(); s.add(img); this.save(s); this.updateCounter();
    },
    remove: function(img) {
      var s = this.load(); s.delete(img); this.save(s); this.updateCounter();
    },
    has: function(img) { return this.load().has(img); },
    count: function()  { return this.load().size; },
    updateCounter: function() {
      var n = this.count();
      document.querySelectorAll('.nav-fav-count').forEach(function(el) {
        el.textContent = n;
        el.style.display = n > 0 ? 'inline-flex' : 'none';
      });
    }
  };
})();
