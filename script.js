//global variables
var xhr = new XMLHttpRequest();


// send blogpost data to database:

function submitblog(){  //submits new blog post to submit.php
	var blog_title =  document.getElementById('title_input').value;  
	var blog_catagory = document.getElementById('catagories_input').value;
	var blog_text = document.getElementById('text_input').value;
	
	var url= "blogtitle="+ blog_title +"&blogcatagory=" + blog_catagory+ "&blogtext=" + blog_text;  
	xhr.open("POST","submit.php", true); //POST request
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
  	xhr.send(url);

};


//gets all blogposts from database

function getallposts(){ 
	document.getElementById("blog_row").innerHTML = ""; //clears div containing blogposts
	
	var surl = "getmessages.php?action=read"; 
	xhr.open('GET', surl, false);
 	var newblogposts=xhr.response; //all blog posts from database
	xhr.send();
	
	var blogs_array = JSON.parse(xhr.response);
	
	for (var post in blogs_array) { //creates blog cards for every item in the list
       if (blogs_array.hasOwnProperty(post)) {
        //create elements for full post, title, and content.
        var blogcard = document.createElement("div"); //creates main blog card
          	blogcard.id = blogs_array[post].ID;
			blogcard.className = 'card_blog';

        var blogcard_title = document.createElement("div") 
        	blogcard_title.className = 'card_title';
        var blogcard_title_content = document.createElement("H2")

        var blogcard_catagory_content = document.createElement("H5") 

        var blogcard_content = document.createElement("div") 
        	blogcard_content.className = 'card_content';

		//creates textnode with title, catagory, and text
    	var blog_text = document.createTextNode(blogs_array[post].text); 
   		var blog_title = document.createTextNode(blogs_array[post].title);
   		var blog_catagory = document.createTextNode(blogs_array[post].catagory);

   		//adds textnodes to corresponding elements
   		blogcard_title_content.appendChild(blog_title);
   		blogcard_title.appendChild(blogcard_title_content);
   		blogcard_catagory_content.appendChild(blog_catagory);
		blogcard_content.appendChild(blog_text);
		    
		//add elements to main blog div
		blogcard.appendChild(blogcard_title);
		blogcard.appendChild(blogcard_catagory_content);
		blogcard.appendChild(blogcard_content);
		document.getElementById("blog_row").appendChild(blogcard);
		}
    }
};

//gets the newest 5 messages from all catagories	
function getfiveposts(){ 
	document.getElementById("blog_row").innerHTML = ""; //clears blog div
	
	var surl = "getmessages.php?action=read"; 
	xhr.open('GET', surl, false);
 	var newblogposts=xhr.response; 
	xhr.send();
	
	var blogs_array = JSON.parse(xhr.response);
	var blogs_array_firstfive = blogs_array .slice(0, 5); //slices array so only the frist five objects are used
	
	for (var post in blogs_array_firstfive) { 
       if (blogs_array_firstfive.hasOwnProperty(post)) {
        
		//create elements for full post, title, and content.
        var blogcard = document.createElement("div"); 
          	blogcard.id = blogs_array[post].ID;
			blogcard.className = 'card_blog';

        var blogcard_title = document.createElement("div") 
        	blogcard_title.className = 'card_title';
        var blogcard_title_content = document.createElement("H2")

        var blogcard_catagory_content = document.createElement("H5") 

        var blogcard_content = document.createElement("div") 
        	blogcard_content.className = 'card_content';

		//creates textnode with title, catagory, and text
    	var blog_text = document.createTextNode(blogs_array[post].text); 
   		var blog_title = document.createTextNode(blogs_array[post].title);
   		var blog_catagory = document.createTextNode(blogs_array[post].catagory);
   		
   		//adds textnodes to corresponding elements
   		blogcard_title_content.appendChild(blog_title);
   		blogcard_title.appendChild(blogcard_title_content);
   		blogcard_catagory_content.appendChild(blog_catagory);
		blogcard_content.appendChild(blog_text);
		    
		//add elements to main blog div
		blogcard.appendChild(blogcard_title);
		blogcard.appendChild(blogcard_catagory_content);
		blogcard.appendChild(blogcard_content);
		document.getElementById("blog_row").appendChild(blogcard);
		}
    }
};

	
//get all messages in selected catagory
function sortbycatagory(catagory){ 
	document.getElementById("blog_row").innerHTML = ""; //clear blog div
	var surl = "getmessages.php?action=sort&catagory=" + catagory ; 

	xhr.open('GET', surl, false);
 	var newblogposts=xhr.response; 
	xhr.send();
	var blogs_array = JSON.parse(xhr.response);

	for (var post in blogs_array) {
       if (blogs_array.hasOwnProperty(post)) {
        
		//create elements for full post, title, and content.
        var blogcard = document.createElement("div"); //creates main blog card
          	blogcard.id = blogs_array[post].ID;
			blogcard.className = 'card_blog';

        var blogcard_title = document.createElement("div") 
        	blogcard_title.className = 'card_title';
        var blogcard_title_content = document.createElement("H2")

        var blogcard_catagory_content = document.createElement("H5") 

        var blogcard_content = document.createElement("div") 
        	blogcard_content.className = 'card_content';

		//creates textnode with title, catagory, and text
    	var blog_text = document.createTextNode(blogs_array[post].text); 
   		var blog_title = document.createTextNode(blogs_array[post].title);
   		var blog_catagory = document.createTextNode(blogs_array[post].catagory);
   		
   		//adds textnodes to corresponding elements
   		blogcard_title_content.appendChild(blog_title);
   		blogcard_title.appendChild(blogcard_title_content);
   		blogcard_catagory_content.appendChild(blog_catagory);
		blogcard_content.appendChild(blog_text);
		    
		//add elements to main blog div
		blogcard.appendChild(blogcard_title);
		blogcard.appendChild(blogcard_catagory_content);
		blogcard.appendChild(blogcard_content);
		document.getElementById("blog_row").appendChild(blogcard);
		}
    } 
};




