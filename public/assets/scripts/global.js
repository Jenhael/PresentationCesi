function displaySelectedFileName(input) {
    var fileName = input.files[0].name;
    document.querySelector('.selected_file').innerText = fileName;
}

$(function() {
    $('.datepicker').datepicker({
        dateFormat: 'yy-mm-dd' 
    });
});