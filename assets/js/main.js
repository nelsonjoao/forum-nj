function altera_post(id)
{
    console.log(id);
	
	var post = document.getElementById('post_hidden_'+id).value;
    document.getElementById('sml_post_'+id).innerText=post;
}
