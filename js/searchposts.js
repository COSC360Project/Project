
var keyword = document.getElementById('search-keyword').value;
var url = '../displaysearchposts.php';

function displayresults(posts) {
    var output = '';
    for (var p in posts) {
        output += "<div class='post-entry'>";
        output += "<table><tr><th><h2>"+posts[p].title+"&nbsp;by&nbsp;"+posts[p].username+"</h2></th></tr>";
        output += "<tr><td>Date posted:&nbsp;"+posts[p].date+"</td></tr>";
        output += "<tr><td>"+posts[p].content+"</td></tr>";
        output += "<tr><td style='text-align:right'>Category:&nbsp;"+posts[p].category+"</td></tr>";
        output += "</table></div>";
    }
    return output;
}

function searchposts() {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'displaysearchposts.php', true);

    xhr.onload = function() {
        if (this.statue == 200) {
            var searchresults = JSON.parse(this.responseText);

            var searchOutput = displayresults(searchresults);
            document.getElementById('featured-posts-left').innerHTML = searchOutput;
        }
    }
    xhr.send();
}


$(document).ready(function() {
    $('#search').addEventListener('click',searchposts());
});