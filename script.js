function addInput(use)
{
	//alert('dans la fonction');
	var form = document.getElementById('form');
	
	var children = form.childNodes;
	var add = document.getElementById('add');
	var input = document.createElement('input');

	input.type='file';
	input.name='media'+use;
	form.insertBefore(input, form.childNodes[children.length-5]);
    
    use++;
    return use;
}