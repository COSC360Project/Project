var request = new XMLHttpRequest();

request.open('GET','displaysortedposts.php');

request.onreadystatechange = function() {
    if (this.readyState === 4 && this.status === 200) {
        $('#featured-posts-left').innerHTML = this.responseText;
    }
};

var categoryForm = document.getElementById("sort-posts-by");
var formData = new FormData(myForm);

request.send(formData);

$(document).onload = function() {

}