(function () {
  'use strict';
  $(function () {
    $(document).on('click', '.btn-add-to-cart', function (e) {
      e.preventDefault();
      var $modal = $('#cartAddedModal');
      if ($modal.length) {
        $modal.modal('show');
      } else if (window.alert) {
        alert('Товар добавлен в корзину');
      }
    });
  });
})();
