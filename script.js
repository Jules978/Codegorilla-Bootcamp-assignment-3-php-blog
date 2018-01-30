//global variables
var xhr = new XMLHttpRequest();
var blog_ids = ""; //all blogposts available for catagory
var highest_id =0; //highest ID/ newest blogpost on the page.

//1: send blogpost data to database:

function submitblog(){ 
	var blog_title =  document.getElementById('title_input').value;  
	var blog_catagory = document.getElementById('catagories_input').value;
	var blog_text = document.getElementById('text_input').value;
	
	console.log(blog_title);
	console.log(blog_catagory);
	console.log(blog_text);
 
	var url= "blogtitle="+ blog_title +"&blogcatagory=" + blog_catagory+ "&blogtext=" + blog_text;  
	xhr.open("POST","submit.php", true); //POST request
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
  	xhr.send(url);
	
	xhr.onload = function () {
   		console.log(xhr.response);
    }; 
};
//2: get blogposts from database, display as a card div.


function getids(){
	var url = "getmessages.php?action=list"; 
	xhr.open('GET', url, false);
	xhr.send();
		//var responseids= xhr.response;
    		var correctids = JSON.parse(xhr.response);
    		
    	for (i = 0; i < correctids.length; i++) {
		correctids[i] = parseInt(correctids[i]); 
	}
	console.log(correctids);

	/*
    	for (i = 0; i < correctids.length; i++) { //for loop, calls getmessage(id) for every ID that is higher then the highestId variable.
		if (correctids[i] > highestId) {
			
			getposts(correctids[i]);
			var newMessage = xhr.response; 
			console.log(newMessage);//saves response from every request as a variable.
			document.getElementById("messages").innerHTML += newMessage + "<br>"; //posts the new message into the chat div as a new line.
			scrollToBottom(); // automatically scrolls to the last message (at the bottom of the div)
			
			highestId = correctids[i]; //saves the last id in the array as the highestid, so the loop doesn't repeat until there is a new message (new higher id).
			}
		} */
		
};
	
function getposts(){ //gets messages from api.php (.txt file) getposts(id)
	var id= 15;
	var surl = "getmessages.php?action=read&postid=" + id ; //"getmessages.php?action=read&id=" + id; 
	xhr.open('GET', surl, false);
 	var newblogposts=xhr.response; //messages arrive as one giant string, separated by "ENTER"
	xhr.send();
	console.log(xhr.response);
	var blogs_array = JSON.parse(xhr.response);

	var array_length = blogs_array.length;
	console.log(array_length);

	 for (var post in blogs_array) {
       if (blogs_array.hasOwnProperty(post)) {
        console.log(blogs_array[post].ID);

        var blogcard = document.createElement("div");
          	blogcard.id = blogs_array[post].ID;
			blogcard.className = 'card_blog';

        var blogcard_title = document.createElement("div")
        	blogcard_title.className = 'card_title';
        var blogcard_title_content = document.createElement("H2")

        var blogcard_catagory_content = document.createElement("H5")

        var blogcard_content = document.createElement("div")
        	blogcard_content.className = 'card_content';

    	var blog_text = document.createTextNode(blogs_array[post].text);
   		var blog_title = document.createTextNode(blogs_array[post].title);
   		var blog_catagory = document.createTextNode(blogs_array[post].catagory);
   		
   			blogcard_title_content.appendChild(blog_title);
   			blogcard_title.appendChild(blogcard_title_content);
   			blogcard_catagory_content.appendChild(blog_catagory);
		    blogcard_content.appendChild(blog_text);
		    

		    blogcard.appendChild(blogcard_title);
		    blogcard.appendChild(blogcard_catagory_content);
		    blogcard.appendChild(blogcard_content);
		    document.getElementById("blog_row").appendChild(blogcard);
		    
}
       }
    };

	/*console.log(blogs_json_array.length);
	for(var i = 0; i < blogs_json_array.length; i++) {
    var obj = blogs_json_array[i];

    
			} */





//3: sort by newest, add catagories.

//4. add delete and maybe edit option.