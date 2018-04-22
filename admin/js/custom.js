/*This is our custom js file*/
jQuery(document).ready(function () {
    jQuery('#example-owt').DataTable();
    
    jQuery("#frmAddPlaylists").validate({
        submitHandler:function(){
            // go and save this info
            var postdata = jQuery("#frmAddPlaylists").serialize()+"&action=boiler_request&param=save_playlist";
            jQuery.post(boiler_ajax_url,postdata , function(response){
                var data = jQuery.parseJSON(response);
                //data.status
                //data.message
                if(data.status==1){
                    alert(data.message);
                }else{
                    alert(data.message);
                }
                location.reload();
            });
        }
    });
    
    jQuery("#media-upload").on("click",function(){
        var image = wp.media({
            title:"Upload Image for Boiler",
            multiple:false
        }).open().on("select",function(){
           var files = image.state().get("selection").first();
           //var files = image.state().get("selection");
           var jsonFiles = files.toJSON();
           jQuery("#media-image").attr("src",jsonFiles.url);
           jQuery("#image-url").val(jsonFiles.url);
           //console.log(jsonFiles);
           /*jQuery.each(jsonFiles,function(index,item){
               console.log(item.title+" , "+item.url);
           });*/
        });
    });
   
});