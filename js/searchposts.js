$(document).ready(function() {
    function searchPosts() {
        // Get keyword from search bar
        var keyword = document.getElementById('search-keyword').value; 

        // Create XMLHttpRequest object
        var request = new XMLHttpRequest();

        // Instantiating request object
        request.open("GET", "displaysearchposts.php?keyword="+keyword);

        // Define event listener for readystatechange event
        request.onreadystatechange = function() {
            // Check if request is complete and was successful
            if (this.readyState===4 && this.status===200) {
                // Insert response from server into HTML element
                document.getElementById('featured-posts-left').innerHTML = this.responseText;
            }
        };

        // Sending request to server
        request.send();
    }
});