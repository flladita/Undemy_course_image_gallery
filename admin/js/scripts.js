$('#summernote').summernote( {

        height: 200
});

/****************** Delete Function ******************/

$(".delete_link").click(function (){

       return confirm("Are you sure you what to delete this item?");

});
