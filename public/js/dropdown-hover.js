(function(){
  function isDesktop(){ return window.matchMedia('(min-width: 992px)').matches; }
  var timers = new WeakMap();
  function show($dd){ $dd.addClass('show'); $dd.find('> .dropdown-menu').addClass('show'); $dd.find('> a.dropdown-toggle').attr('aria-expanded', 'true'); }
  function hide($dd){ $dd.removeClass('show'); $dd.find('> .dropdown-menu').removeClass('show'); $dd.find('> a.dropdown-toggle').attr('aria-expanded', 'false'); }

  $(function(){
    var $dropdowns = $('.navbar .dropdown');
    $dropdowns.each(function(){
      var $dd = $(this);
      $dd.on('mouseenter', function(){
        if (!isDesktop()) return;
        clearTimeout(timers.get($dd));
        timers.set($dd, setTimeout(function(){ show($dd); }, 220));
      });
      $dd.on('mouseleave', function(){
        if (!isDesktop()) return;
        clearTimeout(timers.get($dd));
        timers.set($dd, setTimeout(function(){ hide($dd); }, 220));
      });
    });
  });
})();
