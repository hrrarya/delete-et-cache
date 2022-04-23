// window.onload = (function () {
//   const urlNow = window.location.href;
//   const deleteCache = document.querySelector(
//     "#wp-admin-bar-dec_delete_cache_menu .ab-item"
//   );

//   deleteCache.addEventListener("click", async () => {
//     const res = await fetch(window.etCore.ajaxurl, {
//       method: "POST",
//       body: JSON.stringify({
//         action: "dec_delete_cache",
//         urlNow,
//       }),
//     });

//     console.log(res.json());
//   });

//   //   console.log(deleteCache);
//   //   console.log(urlNow);
// })();

(function ($) {
  const deleteCacheBtnContainer = $("#wp-admin-bar-dec_delete_cache_menu");
  const deleteCache = $("#wp-admin-bar-dec_delete_cache_menu .ab-item");

  deleteCacheBtnContainer.append(
    '<div class="spinner" style="float:none;width:auto;height:auto;padding:10px 0 10px 50px;background-position:20px 0;">'
  );

  deleteCache.on("click", function () {
    $(".spinner").addClass("is-active");
    $.ajax({
      url: DecDeleteET.ajaxurl,
      method: "POST",
      data: {
        action: "dec_delete_cache",
      },
      success: function (data) {
        if (data.isDone) {
          $(".spinner").removeClass("is-active");

          console.log(data);
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(errorThrown);
      },
    });
  });
})(jQuery);
