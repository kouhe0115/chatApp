$(function(){
    $('#user__image').on('change', function(e) {
        let file = e.target.files[0],
            reader = new FileReader(),
            $preview = $(".preview");
        t = this;

        if(file.type.indexOf("image") < 0){
            return false;
        }

        reader.onload = (function(file) {
            return function(e) {
                $preview.empty();
                $preview.append($('<img>').attr({
                    src: e.target.result,
                    class: "user__image",
                }));
            };
        })(file);

        reader.readAsDataURL(file);
    });
});
