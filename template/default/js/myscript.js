$(document).ready(function() {
	//var data, =JSON.parse(dist);
//footer.php, который находиться в теме там я подключил этот скрипт и выше подключил языковые файлы, которые передал в этот скрипт


/*-------опредедяем правила валидации затем этот масив будет использован к нужному инпуту--------------------*/
var valid =new Array();
valid['login']={required: 'required', max:6, unique:true, reqv: /^[a-z][\w\s]*/i};//логин регистрации
valid['login2']={required: 'required', max:6, unique:true, reqv: /^[a-z][\w\s]*/i};//логин на странице авторизации
valid['pass']={required: 'required',max:6,reqv: /[a-z\w]+/i, repass:'repass'};//пароль регистрации
valid['email']={required: 'required', email: 'email',unique:true, reqv: /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,6})+$/i};//пишем правила для email
valid['repass']={required: 'required',repass:'repass'};//повторение пароля регистрации
valid['pas']={required: 'required',reqv: /[a-z\w]+/i,};//пароль на странице логина




var flag = true;//если есть хоть одна ошибка валидации то меняем значение на false, чтобы не отправить форму при нажатии submit
var input=$(document).find($('.input'));//берем инпуты в выборку
input.each(function(){//проходимся по всем инпутам в выборке
ff($(this),[{email:'email',login:'login',pass: 'pass', repass: 'repass',pas: 'pas',login2:'login2'}]);//передаем первым параметром инпут на каждой итерации
		
		
		
})

		function ff(obj,arr){
		var id=obj.attr('id');//получаем id инпута
		
		
		$(document).on('blur','#'+id, function(){//потеря фокуса с поля инпута
			var value =obj.val();
			id=obj.attr('id');
			
		if(id == arr[0].email){//потеря фокуса с поля email, для этого создали объект arr, чтобы отлавливать нужные инпуты
			if(valid['email'].email == 'email') {if(validateemai(id,value,valid['email'].reqv) != true){flag = false;return false}};
			if(valid['email'].required == 'required') {if(required(id,value) !=true ){flag = false;return false}};
			if(valid['email'].unique){if(unique(id,value) != true){return false}};
			flag = true;success(id);return false;
			};
			
		if(id == arr[0].login){//потеря фокуса с поля login, для этого создали объект arr, чтобы отлавливать нужные инпуты
			  if(valid['login'].required == 'required'){if( required(id,value) != true ){flag = false;return false}};
			  if(valid['login'].reqv){if( regular(id,value, valid['login'].reqv) != true ){flag = false;return false}};
			  if(valid['login'].max){if( max(id,value, valid['login'].max) != true ){flag = false;return false}};
			  if(valid['login'].unique){if(unique(id,value) != true){flag = false;return false}};
			  flag = true;success(id);return false;
			};
			
		if(id == arr[0].pass){//потеря фокуса  с поля пароль, для этого создали объект arr, чтобы отлавливать нужные инпуты
			
			if(valid['pass'].required == 'required'){if( required(id,value) != true ){flag = false;return false}};
			if(valid['pass'].repass == 'repass'){if( validatepass(id,value) != true ){flag = false;return false}};
			if(valid['pass'].reqv){if( regular(id,value, valid['pass'].reqv) != true ){flag = false;return false}};
			if(valid['pass'].max){if( max(id,value, valid['pass'].max) != true ){flag = false;return false}};
			flag = true;success(id);return false;
			};
		
		
		
		
		if(id == arr[0].repass){//потеря фокуса  с поля повторить пароль, для этого создали объект arr, чтобы отлавливать нужные инпуты
			if(valid['repass'].required == 'required'){if( required(id,value) != true ){flag = false;return false}};
			if(valid['repass'].repass == 'repass'){if( validatepass(id,value) != true ){flag = false;return false}};
			success(id);return false;
			};
		
		if(id == arr[0].pas){//потеря фокуса  с поля пароль на странице логин, для этого создали объект arr, чтобы отлавливать нужные инпуты
			if(valid['pas'].required == 'required'){if( required(id,value) != true ){flag = false;return false}};
			if(valid['pas'].reqv){if( regular(id,value, valid['pass'].reqv) != true ){flag = false;return false}};
			flag = true;success(id);return false;
			};
			
			if(id == arr[0].login2){//потеря фокуса  с поля логин на странице логин, для этого создали объект arr, чтобы отлавливать нужные инпуты
			if(valid['login2'].required == 'required'){if( required(id,value) != true ){flag = false;return false}};
			if(valid['login2'].max){if( max(id,value, valid['login2'].max) != true ){flag = false;return false}};
			if(valid['login2'].reqv){if( regular(id,value, valid['login2'].reqv) != true ){flag = false;return false}};
			flag = true;success(id);return false;
			};
		
		
		})
		
		
		
		
	}
	function unique(id,value){//функция для проверки уникальности логина и email
	    $.ajax({
         url:"register",
         type:"POST",
         data:({'id':id, value:value}),
         beforeSend:function(){
			 error(id, '...подождите идет проверка')},
         success:function(data){
		 //третий параметр функции error() - label[id], это перевод с языкового файла например если id = login, то label[id] вернет логин
		      if(data == 'ok'){return error(id, dist['unique'],label[id])}
		      if(data == 'no'){return success(id)};
				}
               })
		    }
	
	function regular(id,value,param){//функция для проверки полей на регулярное выражение,например логин должен быть на латинице
		var reqv = param;
		var req=value.match(reqv);
		if(req === null){return error(id,dist['latin'],label[id])};
		     return true;
	  }
	  
		function max(id,value,param){//функция проверки значения поля на количество символов, например логин должен быть не менне 6 символов
	         var zize = value.length;
			 if(zize < param ){return error(id, dist['max']+' '+ param, label[id])};
			 return true;
	    }
		
	    function validatepass(id,value){//функция проверки пароля на совпадение с повтором пароля
			if(id == 'pass'){//если текущий инпут это пароль
			 var pass = $('#repass').val();//тогда вычисляем значение повтор пароля
		 }
		 
		 if(id == 'repass'){//если текущее значение инпута повторение пароля
			 var pass = $('#pass').val();//тогда вычисляем значение пароля

		 }
			if(value != '' && pass !=''){//будем возвращать сообщение о несовпадение, когда оба поля не пустые
			if(value != pass){return error(id,dist['repass'])}else{//если текущее значение не равно значению другого поля то ошибка
			if(id == 'repass'){return success('pass')}//если совпали поля, если текущий инпут - повтор пароля то убираем ошибку в этом поле
			if(id == 'pass'){return success('repass')};//если совпали поля, если текущий инпут - пароль то убираем ошибку в этом поле
		}
			}
	
		 return true;
		
			}
	
	 
		 function required(id,value){//функция проверки значения инпута на пустату, если обезательное то выводим ошибку
			//обязательность определяется в масиве valid
			
			 if(value == ''){return error(id, dist['required'], label[id])};
			 return true;
		 }
		 
		 
		function validateemai(id,value,reqv){//проверка email 
			var req = value.match(reqv);
			if(req == null){return error(id, dist['email'], label[id])}
				return true;
			}


       function success(id){//функция для отмены ошибок валидации
	         $('#'+id).parents('.form-group').removeClass('has-error').addClass('has-success');
		      $('#'+id).parents('.form-group').find('.error').text('');
				return true
		      }
	   function error(id, texts,param3){//функция для вывода ошибок валидации
		        
		       $('#'+id).parents('.form-group').removeClass('has-success').addClass('has-error');
		       $('#'+id).parents('.form-group').find('.error').text(param3+' '+texts);
		       return false;
	}
	
	
	
	
   /*отправка формы*/
     $(document).on('submit','#form',function(){
	    input.each(function(){
	    var id = $(this).attr('id');
		var val = $('#'+id).val();
		if(valid[id].required && val == ''){//если для этот инпут обязателен то выводим ошибку
			$('.form-group').addClass('has-error');
			flag = false;
		}
		 else{
			success(id);
			flag = true;
			 };
	    })//each
	
    if(flag === false){//если есть ошибки то блокируем отправку формы
		 return false;
	 }
	 
	
	 
	 
	 
	 
})//ready
		  

	
	
	
	
	
	
	
	
	
	
})