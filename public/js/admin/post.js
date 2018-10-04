/**
 * admin.post.*
 */
function prependSpaceToCateList(){
  $("option[class^='level-']").each(function(){
      var str = $(this).attr('class');
      var level = parseInt(str.slice(6));
      if (level >= 1) {
          for(var i = 1; i <= level; i++) {
              $(this).prepend("&nbsp;&nbsp;&nbsp;");
          }
      }
  });
}

/**
 * admin.post.create
 */
$(document).ready(function(){

    prependSpaceToCateList();

    /**
    * Tiny MCE
    */
   tinymce.init({
        selector: '#postContent',
        menubar: "tools",
        plugins: [
            'advlist autolink link lists charmap print preview hr anchor pagebreak spellchecker',
            'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
            'save table contextmenu directionality emoticons template paste textcolor',
            'colorpicker visualblocks table codesample hr contextmenu textpattern image imagetools'
        ],
        dvlist_bullet_styles: 'square',
        advlist_number_styles: 'lower-alpha,lower-roman,upper-alpha,upper-roman',
        toolbar: [
            'hr | codesample | table | visualblocks | code | insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | fullscreen',
            'forecolor backcolor | emoticons | searchreplace | insertdatetime | fontsizeselect'
        ],
        contextmenu: "link image inserttable | cell row column deletetable",
        fontsize_formats: '8pt 10pt 11pt 12pt 13pt 14pt 18pt 19pt 22pt 24pt 27pt 36pt 40pt',
        imagetools_toolbar: "rotateleft rotateright | flipv fliph | editimage imageoptions",
        image_caption: true,
        image_upload_url: uploadImageToContent,
        images_upload_handler: function (blobInfo, success, failure) {
            var xhr, formData;
            xhr = new XMLHttpRequest();
            xhr.withCredentials = true;
            xhr.open('POST', uploadImageToContent);
            xhr.setRequestHeader("X-CSRF-TOKEN", token);
            xhr.onload = function() {
              var json;

              if (xhr.status != 200) {
                failure('HTTP Error: ' + xhr.status);

                return;
              }
              json = JSON.parse(xhr.responseText);

              if (!json || typeof json.location != 'string') {
                failure('Invalid JSON: ' + xhr.responseText);
                conolse.log(xhr.responseText);
                return;
              }
              success(json.location);
            };
            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());
            xhr.send(formData);
         }
   });

   /**
    * action: save draft post
    *
    * @return {[type]} [description]
    */
   $("#draftPostButton").click(function(){
       $("#actionPostInput").val("draft");
       $("#createPostForm").submit();
   });

   $("#publishPostButton").click(function(){
       $("#actionPostInput").val("publish");
       $("#createPostForm").submit();
   });

   /**
    * post slug
    */
   $("#postTitle").on("focusout", function(){
        var title = $(this).val();

        $.ajax({
            method: 'POST',
            url: createSlugFunction,
            data: {
                title: title
            },
        })
        .done(function( data ){
            $("#postSlugSpan").html(data);
            $("#postSlug").val(data);
        })
        .fail(function( data ){
            alert('Error .. !can not create slug');
        });
   });

    var postSlug;

   $("#editPostSlugButton").click(function(){
       $("#postSlugSpan").addClass("d-none");
       $("#postSlug").attr("type", "text");
       postSlug = $("#postSlug").val();
       $(this).addClass("d-none");
       $("#postSlugActionWrap").removeClass("d-none");
   });
   $("#cancelEditPostSlug").click(function(){
      $("#postSlug").attr("type", "hidden").val(postSlug);
      $("#postSlugSpan").removeClass("d-none");
      $("#postSlugActionWrap").addClass("d-none");
      $("#editPostSlugButton").removeClass("d-none");
   });
   $("#saveEditPostSlug").click(function(){
       postSlug = $("#postSlug").val();
      $.ajax({
          method: 'POST',
          url: createSlugFunction,
          data: {
              title: postSlug
          },
      })
      .done(function( data ){
          $("#postSlug").attr("type", "hidden");
          $("#postSlugActionWrap").addClass("d-none");
          $("#postSlugSpan").html(data).removeClass("d-none");
          $("#postSlug").val(data);
          $("#editPostSlugButton").removeClass("d-none");
          $("#postTitle").off();
      })
      .fail(function( data ){
          alert('Error .. !can not create slug');
      });
   });

   /**
    * select post type
    */
   $("#postType").change(function(){
       var postType = $("#postType option:selected").val();
       if (postType == 'post') {
           $("#postProductWrap").addClass("d-none");
       }
       if (postType == 'post_product') {
           $("#postProductWrap").removeClass("d-none");
       }

       $.ajax({
          method: 'POST',
          url: getCateListUrl,
          data: {
            postType: postType
          }
       })
       .done(function(data){
          $("#postCategory").html(data);
          prependSpaceToCateList();
       })
       .fail(function(){
          alert("Error .. Something wrong !");
       });
   });

   /**
    * Add media to content
    */
    $("#addMediaButton").on("click", function(){
        $("#addMediaContainer").removeClass("d-none");
        addMediaFunction();
    });


   function addMediaFunction(){
       /** close media */
       $("#closeAddMediaContainer").click(function(){
           $("#addMediaContainer").addClass("d-none");
       });

        /** toggle upload media */
       $("#toggleCollapseUploadForm").click(function(){
          $("#collapseUploadForm").slideToggle(200);
       });
   }

});
