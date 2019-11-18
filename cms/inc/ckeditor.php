<script src="<?php echo CKEDITOR_PATH; ?>ckeditor.js"></script>
<script type="text/javascript">
  $('#category').on('change',function(){
    var category_id = $('#category').val();
    $.ajax({
      url: 'process/api',
      method: 'post',
      data: {
        cat_id: category_id,
        act: "<?php echo substr(md5('get-child-cat-by-parent-id'.$_SESSION['token']), 3,18); ?>"
      }
    })
    .done(function(data){
      if (typeof(data) != 'object') {
        data = $.parseJSON(data);
      }
      var inner_html = "<option selected disabled>--Select Any One--</option>"
      if (data.status) {
        //show child cat
        $("#sub_cat_div").removeClass('hidden');
        $.each(data.body,function(index,value){
          inner_html += "<option value ='"+value.id+"'>"+value.title+"</option>"
        });
        console.log(inner_html);
        $('#sub_category').html(inner_html);
      }else{
        //hidden child cat
        $("#sub_cat_div").addClass('hidden');
      }
    });
  });
  ckEditor();
  ckEditor2();

  function ckEditor(data=''){
    $('.ck').remove();
    ClassicEditor
        .create( document.querySelector('#description'),{
          ckfinder:{
            uploadUrl: '<?php echo CKFINDER_PATH; ?>core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
          }
        } )
        .then(editor=>{
          //editor.setData(data);
        })
        .catch( error => {
            console.error( error );
        } );
  }
  function ckEditor2(data=''){
    $('.ck').remove();
    ClassicEditor
        .create( document.querySelector('#meta_keywords'),{
          ckfinder:{
            uploadUrl: '<?php echo CKFINDER_PATH; ?>core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
          }
        } )
        .then(editor=>{
          editor.setData(data);
        })
        .catch( error => {
            console.error( error );
        } );
  }
</script>