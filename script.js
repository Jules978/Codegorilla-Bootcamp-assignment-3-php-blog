//global variables
var xhr = new XMLHttpRequest();


// send blogpost data to database:


function submitblog(){  //submits new blog post to submit.php
	var blog_title =  document.getElementById('title_input').value;  
	var blog_category = document.getElementById('categories_input').value;
	 var blog_text = CKEDITOR.instances.editor1.getData();
	 

 var formData = new FormData();

formData.append("blogtitle", blog_title);
formData.append("blogcategory",blog_category); // number 123456 is immediately converted to a string "123456"
formData.append("blogtext", blog_text);
// HTML file input, chosen by user


// JavaScript file-like object


xhr.open("POST","submit.php", true); 
xhr.send(formData);

	
  	
  	document.getElementById("postblog").style.display = "none";
  	document.getElementById("postmessage").style.display = "block"; 

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
       var blog_date = blogs_array[post].date;
        var blog_category_text = blogs_array[post].name;
        var blog_date_category= blogs_array[post].date+ ", in " + blog_category_text;
    //create elements for full post, title, and content.
        var blogcard = document.createElement("div"); 
            blogcard.id = blogs_array[post].ID;
      blogcard.className = 'card_blog';

        var blogcard_title = document.createElement("div") 
          blogcard_title.className = 'card_title';
        var blogcard_title_content = document.createElement("div")
            blogcard_title_content.className= "blog_title_line";
        var blogcard_category_content = document.createElement("div") 
            blogcard_category_content.className= "blog_category_line";

        var blogcard_content = document.createElement("div") 
          blogcard_content.className = 'card_content';

    //creates textnode with title, catagory, and text
      var blog_text = blogs_array[post].text; 
      var blog_title = document.createTextNode(blogs_array[post].title);
      var blog_category = document.createTextNode(blog_date_category);
      
      //adds textnodes to corresponding elements
      blogcard_title_content.appendChild(blog_title);
      blogcard_title.appendChild(blogcard_title_content);
      blogcard_category_content.appendChild(blog_category);
      blogcard_title.appendChild(blogcard_category_content);

    blogcard_content.innerHTML = blog_text;
        
    //add elements to main blog div
    blogcard.appendChild(blogcard_title);

    blogcard.appendChild(blogcard_content);
    document.getElementById("blog_row").appendChild(blogcard);
		}
    }
};

//gets the newest 2 messages from all catagories	
function getfiveposts(){ 
	document.getElementById("blog_row").innerHTML = ""; //clears blog div
	
	var surl = "getmessages.php?action=read"; 
	xhr.open('GET', surl, false);
 	
	xhr.send();
	var newblogposts=xhr.response; 
	
	var blogs_array = JSON.parse(xhr.response);
	var blogs_array_firstfive = blogs_array .slice(0, 2); //slices array so only the frist five objects are used
	
	for (var post in blogs_array_firstfive) { 
       if (blogs_array_firstfive.hasOwnProperty(post)) {
        var blog_date = blogs_array[post].date;
        var blog_category_text = blogs_array[post].name;
        var blog_date_category= blogs_array[post].date+ ", in " + blog_category_text;
		//create elements for full post, title, and content.
        var blogcard = document.createElement("div"); 
          	blogcard.id = blogs_array[post].id;
			blogcard.className = 'card_blog';

        var blogcard_title = document.createElement("div") 
        	blogcard_title.className = 'card_title';
        var blogcard_title_content = document.createElement("div")
            blogcard_title_content.className= "blog_title_line";
        var blogcard_category_content = document.createElement("div") 
            blogcard_category_content.className= "blog_category_line";

        var blogcard_content = document.createElement("div") 
        	blogcard_content.className = 'card_content';

		//creates textnode with title, catagory, and text
    	var blog_text = blogs_array[post].text; 
   		var blog_title = document.createTextNode(blogs_array[post].title);
   		var blog_category = document.createTextNode(blog_date_category);
   		
   		//adds textnodes to corresponding elements
   		blogcard_title_content.appendChild(blog_title);
   		blogcard_title.appendChild(blogcard_title_content);
   		blogcard_category_content.appendChild(blog_category);
      blogcard_title.appendChild(blogcard_category_content);

		blogcard_content.innerHTML = blog_text;
		    
		//add elements to main blog div
		blogcard.appendChild(blogcard_title);

		blogcard.appendChild(blogcard_content);
		document.getElementById("blog_row").appendChild(blogcard);

    //create comment section

    var commentfield_id= "comments"+blogs_array[post].id;
    var comment_section_id= "commentsection"+blogs_array[post].id;
    var comment_input_id= "commentinput"+blogs_array[post].id;

    var commentsection = document.createElement("div");
    commentsection.className = "commentsection";
    commentsection.id= blogcard.id;
    //commentsection.onload = function(){ };
     var comments = document.createElement("div");
     comments.id = commentfield_id;
     var commentinput = document.createElement("div");
      
      
        //commentform.onsubmit =  postcomment(this.id) {{ return false }};
        var commenttext = document.createElement("input");
        commenttext.id = comment_input_id;
        commenttext.setAttribute('type', 'text');
         commenttext.placeholder='Your comment';
         var commentsubmit = document.createElement("div");
        commentsubmit.id =  blogcard.id;
        commentsubmit.innerHTML="send comment";
        commentsubmit.onclick =  function() { submitcomment(this.id) };
        var commenttest = document.createElement("div");
        commenttest.id =  blogcard.id;
        commenttest.innerHTML="get comments";
        commenttest.onclick =  function() { getcommentids(this.id) };
      
        //commentsubmit.onsubmit =  postcomment(this.id) { return false };
commentinput.appendChild(commenttext);
commentinput.appendChild(commentsubmit);
commentinput.appendChild(commenttest);

commentsection.appendChild(comments);
commentsection.appendChild(commentinput);
blogcard.appendChild(commentsection);


		}
    }
};

	
//get all messages in selected catagory
function sortbycategory(category){ 
	document.getElementById("blog_row").innerHTML = ""; //clear blog div
	var surl = "getmessages.php?action=sort&category=" + category ; 

	xhr.open('GET', surl, false);
 	var newblogposts=xhr.response; 
	xhr.send();
	var blogs_array = JSON.parse(xhr.response);

	for (var post in blogs_array) {
       if (blogs_array.hasOwnProperty(post)) {
        
		var blog_date = blogs_array[post].date;
        var blog_category_text = blogs_array[post].name;
        var blog_date_category= blogs_array[post].date+ ", in " + blog_category_text;
    //create elements for full post, title, and content.
        var blogcard = document.createElement("div"); 
            blogcard.id = blogs_array[post].ID;
      blogcard.className = 'card_blog';

        var blogcard_title = document.createElement("div") 
          blogcard_title.className = 'card_title';
        var blogcard_title_content = document.createElement("div")
            blogcard_title_content.className= "blog_title_line";
        var blogcard_category_content = document.createElement("div") 
            blogcard_category_content.className= "blog_category_line";

        var blogcard_content = document.createElement("div") 
          blogcard_content.className = 'card_content';

    //creates textnode with title, catagory, and text
      var blog_text = blogs_array[post].text; 
      var blog_title = document.createTextNode(blogs_array[post].title);
      var blog_category = document.createTextNode(blog_date_category);
      
      //adds textnodes to corresponding elements
      blogcard_title_content.appendChild(blog_title);
      blogcard_title.appendChild(blogcard_title_content);
      blogcard_category_content.appendChild(blog_category);
      blogcard_title.appendChild(blogcard_category_content);

    blogcard_content.innerHTML = blog_text;
        
    //add elements to main blog div
    blogcard.appendChild(blogcard_title);

    blogcard.appendChild(blogcard_content);
    document.getElementById("blog_row").appendChild(blogcard);
		}
    } 
};


function loadcategories(){

	
	var surl = "getmessages.php?action=cat"; 
	xhr.open('GET', surl, false);
 	
	xhr.send();
	var category_array = JSON.parse(xhr.response);
	
	for (var cat in category_array) {
       if (category_array.hasOwnProperty(cat)) {  
       	var category_name = category_array[cat].name;
       	var category_id = category_array[cat].id;

       	
       //adding categories to sidebar
       	var category_bar = document.createElement("div"); 
       		category_bar.className = 'sidebar_category';

       		category_bar.id = category_id;
       		category_bar.onclick =  function() { sortbycategory(this.id) };

       	var category_bar_text = document.createElement("p");
       		category_bar_text.innerHTML = category_name;
       		category_bar.appendChild(category_bar_text);

       	var sidebar_menu = document.getElementById("card_categories");  
       	sidebar_menu.appendChild(category_bar);

       	       //adding categories to navbar
       	var category_nav = document.createElement("a"); 
       		category_nav.id = category_id;
       		category_nav.onclick =  function() { sortbycategory(this.id) };

       	
       		category_nav.innerHTML = category_name;
       		var navbar_menu = document.getElementById("dropdown_category");  
       		navbar_menu.appendChild(category_nav);

       		//adding categories to selection menu

		var category_option = document.createElement("option"); 
			category_option.value = category_id;
			category_option.innerhtml = category_name;
		var category_select = document.getElementById("categories_input");  

       	/* <select id="categories_input" = name="categories_input" size="4"> 
          <option value="news">News</option> */


       }
       }

};

function loadsubmitcategories(){

	
	var surl = "getmessages.php?action=cat"; 
	xhr.open('GET', surl, false);
 	
	xhr.send();
	var category_array = JSON.parse(xhr.response);
	//console.log(category_array);
	for (var cat in category_array) {
       if (category_array.hasOwnProperty(cat)) {  
       	var category_name = category_array[cat].name;
       	var category_id = category_array[cat].id;

       	

		var category_option = document.createElement("option"); 
			category_option.value = category_id;
			var category_text = document.createTextNode(category_name);
			
			category_option.appendChild(category_text);
		var category_select = document.getElementById("categories_input");  
			category_select.appendChild(category_option);
			

       	/* <select id="categories_input" = name="categories_input" size="4"> 
          <option value="news">News</option> */


       }
       }

};

function showsubmitnewcategory(){

document.getElementById("postblog").style.display = "none";
document.getElementById("postmessage").style.display = "none"; 
document.getElementById("new_category").style.display = "block"; 




}

function submitcategory(){
 var new_category =  document.getElementById('newcategory_input').value;  

	
	 var url= "newcategory="+ new_category ;  
	xhr.open("POST","newcategory.php", true); //POST request
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
  	xhr.send(url); 
  	
  	
    document.getElementById("new_category").style.display = "none";
    document.getElementById("postnew_category").style.display = "block";
    var added_message = new_category + " has been added to the database";
     
    var added_message_textnode = document.createTextNode(added_message);
      document.getElementById("postnew_category").appendChild(added_message_textnode);
      //adds textnodes to corresponding elements
     
};


function submitcomment(sectionid){
var comment_input_id = "commentinput"+sectionid;
var int_sectionid = parseInt(sectionid);
//console.log(int_sectionid);
var msg = document.getElementById(comment_input_id).value;

var url= "message="+ msg +"&sectionid="+ int_sectionid;  
  xhr.open("POST","comments.php", true); //POST request
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
    xhr.send(url); 


} 

function getcommentids(sectionid){

var comment_input_id = "commentinput"+sectionid;
var int_sectionid = parseInt(sectionid);
//console.log(int_sectionid);


var url= "comments.php?action=read&sectionid="+ int_sectionid;  
  xhr.open("GET",url, true); 
  xhr.setRequestHeader("Content-type", 'application/json; charset=utf-8'); 
    xhr.send(url); 
  console.log(xhr.response);

  //var comments_array = JSON.parse(xhr.response);
  //console.log(comments_array);

}




  

