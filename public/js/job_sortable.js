	var list2 = document.getElementById("list2");
	var editableList = Sortable.create(list2, {
		//group: "test",
		animation: 150,
		ghostClass: "ghost",
		filter: '.js-remove',
		onFilter: function(evt) {
			var el = editableList.closest(evt.item);
			//console.log(evt.item.outerText);
			//console.log(evt.item.id);
			el && el.parentNode.removeChild(el);
			$('.js-example-basic-single').append('<option value='+evt.item.id+'>'+evt.item.outerText+'</option>');

            setHiddenInputs(editableList.toArray());
            //getList(evt);
		},
		onSort: function(e) {
			//getList(e);
            setHiddenInputs(editableList.toArray());
		}
	}); 

    function setHiddenInputs(arr)
    {
        console.log(arr);
        //for(var i = 0; i < arr.length; i++)
            //console.log(arr[i]);
        
        for(var i = 0; i < 5; i++)
        {
            var sname = 'skill'+i;
            if($('#'+sname).length>0)
            {
                document.getElementById(sname).value=arr[i];
                //console.log("exists");
            }
            else
            {
                //console.log("doesnt exist");
                $('<input>').attr({
                    type: 'hidden',
                    id: sname,
                    name: sname,
                    value: arr[i]
                }).appendTo('form');
            }
        }
    }
	
	$(document).on('click', '.add-el', function(){
		if($(".list_2 li").length<5)
		{
			var selVal = $("#skill_select").val();
			var selTxt = $("#skill_select option:selected").text();
			$('.js-example-basic-single option[value='+selVal+']').remove();

			$(".list_2").append("<li data-id='"+selVal+"' id='"+selVal+"'><span class='badge badge-primary'>"+selTxt+" &nbsp;<i class='js-remove fa fa-trash'></i></span></li>");

            setHiddenInputs(editableList.toArray());
		}
	});
	