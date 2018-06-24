<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Product</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
	<body>
		<div id="container">
		
		

		</div>
		
		<div id='path'></div>
	<script>

		var datas = {
			'tree': [
				{
					'name': 'name1',
					'tree': [
						{'name': 'name2'},
						{'name': 'name3'},
						{
							'name': 'name4',
							'tree': [
								{'name': 'name5'},
								{'name': 'name6'}
							]
						},
						{'name': 'name7'}
					]
				},
				{
					'name': 'name8',
					'tree': [
						{'name': 'name9'}
					]
				}
			]
		}


		var buildTree = function(tree, container,parentObject) {
			$.each(tree, function(key,item) {
				var newContainer = document.createElement('div');
				var button = document.createElement('button');
				
				button.id = item.name;
				button.innerHTML = item.name;
				item.parent = parentObject;
				newContainer.appendChild(button);
		
				container.appendChild(newContainer);
				 if(item.tree) buildTree(item.tree, newContainer, item);
			});
		}
		buildTree(datas.tree, $('div#container')[0], datas)
		
		
		
		$('div#container').on('click','button' , function (e) {
			getObject(datas.tree, e.target.id, function (target) {
				target.name = 'newName ' + Math.random();
				$('div#container').empty();
				buildTree(datas.tree, $('div#container')[0]);
			});
		});
		
		var getObject = function (container, id, callback) {
			$.each(container, function (key,item) {
				if (item.name === id) callback(item);
				if (item.tree) getObject(item.tree, id, callback);
			});
		}
		
		var a = {
			p1: {key: 'value1'},
			p2: {key: 'value1'}
		};
		var b = getObject(a, {key: 'value1'});
		
		
		var getPath = function (target, path) {
			if( target.parent ) {
				path = target.parent.name + '/' + path;
				return getPath(target.parent, path);
			}
			else return path;
		}
		
		$('div#path').html( 'root/' + getPath(target, '') );
		</script>
	</body>
</html>
	
