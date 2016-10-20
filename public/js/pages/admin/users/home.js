var rebindEverything;

var Page;
Page = {

	Name: "Admin: Users",

	Lib: {

		HideTableRow: function(tr) {

		    tr.find('td').fadeOut(1000, function(){ 
	            // alert($(this).text());
	            $(this).parents('tr:first').remove();                    
	        });    
		},

		// Todo: Some spinning icon or something
		_QueryIndex: 0,
		_LQueryIndex: 0,

		LoadTableRows: function(query) {
			if(query == null || query == "")
				query = "*";

			console.log("Querying ("+query+") with Index: " +(Page.Lib._QueryIndex + 1));

			// Just wrap around for safety
			// You never know maybe they never
			// close the tab for the next couple of 
			// years?
			if (Page.Lib._QueryIndex >= 2147483640) 
				Page.Lib._QueryIndex = 0;

			// Make sure we are using the 
			// latest query, by doing so
			// we update this value every
			// time we do a new search
			// and when we recieve the query
			// back from the server, we just
			// check if the index is the same
			// if so display the rows if not
			// just ignore it.
			var qIndex = ++Page.Lib._QueryIndex;
			var route  = Laravel.RootURL + "admin/users/" + query;

			$.ajax({
			    url:  route,
			    type: 'post',
			    success: function(r) {
			    	var show = (Page.Lib._QueryIndex == qIndex);

			    	if (!show) {
			    		if (Page.Lib._LQueryIndex < qIndex) {
			    			_LQueryIndex = qIndex;
			    			show = true;
			    		}
			    	}

			    	if (show) {
			    		// Same query index
			    		$("#user_body").empty();
			    		$("#user_body").html(r);

					    rebindEverything();
			    	}
					
			    	// Else just ignore the response
			    }
			});
		}
	},

	API: {

		DeleteUser: function(id, n) {
			bootbox.confirm("Are you sure you want to delete the user "+n+" ("+id+") !", 
			
			function(result) { 
				var delSuc = "The user "+n+" ("+id+") was deleted successfully!";
				var delErr = "Failed to delete user "+n+" ("+id+") with error: ";
				var route  = Laravel.RootURL + "admin/user/" + id;

				if (result) {
					$.ajax({
					    url:  route,
					    type: 'post',
					    data: {_method: 'delete'},
					    success: function(r) {
					    	/*var model = {
					    		deleted: true/false,
					    		error: ""
					    	};*/

					    	if (r.deleted) {
					    		Page.Lib.HideTableRow($('#user_row_'+id));

								bootbox.alert({
								    message: delSuc, 
								    backdrop: true
								});
					    	} else {
								bootbox.alert({
								    message:
								    	delErr + 
								    	r.error, 
								    backdrop: true
								});
					    	}
					    }
					});
				}
			});

		},

		GetUsername: function($o, from) {
			var f_Tab = 0, f_Btn = 1;
			
			if (from == f_Tab) {
				return ($o.find('.title').html()).trim();
			} else {
				// We are located in 
				//      li > a > i
				// we need:
				//      li > a > a > div > .title
				return ($($o.parent()).parent().find('.title').html());
			}
		},

		GetID: function($o) {
			return $($o).find('.code_page-edit-user-btn').attr('user_id');
		}
	}
};

var $query_Input;
var $query_Go;
var $checkbox_rt;
var $edit_tab;
var $edit_btn;
var $edit_accpt;
var $edit_user;
var $edit_id;
	
function GotoEditUser(id) {
	var url = Laravel.RootURL + "admin/user/" + id;
	window.location = url;
}

var isRealTime = function() {
	return $checkbox_rt.is(':checked');
};

var getQueryString = function() {
	return $query_Input.val();
};

var binds = function() {
	$query_Input = $('#page_query_input');
	$query_Go 	 = $('#page_query_go');
	$checkbox_rt = $('#page_realtime_search');
	$edit_tab    = $('.code_page-edit-user-tab');
	$edit_btn    = $('.code_page-edit-user-btn');
	$edit_accpt  = $('#page_edit_mobile_accept');
	$edit_user   = $('#page_edituser_name');
	$edit_id     = $('#page_edituser_id');
	
	$query_Go.on('click', function() {
		var redir = Laravel.RootURL + "/admin/users/" + getQueryString();
		window.location = redir;
	});

	$query_Input.keyup(function(e) {
		if (isRealTime() || e.which == 13)
			Page.Lib.LoadTableRows(getQueryString());
	});

	$query_Go.on('click', function() {
		var redir = Laravel.RootURL + "/admin/users/" + getQueryString();
		window.location = redir;
	});
};

rebindEverything = function()  {
	$edit_tab    = $('.code_page-edit-user-tab');
	$edit_btn    = $('.code_page-edit-user-btn');
	
	$edit_tab.on('click', function(){
		// IF   the user is on mobile
		//    Display a prompt asking if 
		//         they want to edit the 
		//                          user
		// ELSE do nothing
		
		if (Laravel.Website.isTouch()) {
			
			var $me  = $(this);
			var id   = Page.API.GetID($me);
			var name = Page.API.GetUsername($me, 0);
			
			console.log($me, id, name);
			
			$edit_user.html(name);
			$edit_id.html(id);
			
			$edit_accpt.off('click');
			$edit_accpt.on('click', function() {
				GotoEditUser(id);
			});

			// Show the modal
			$('#page_edituser_areyousure').modal('show');
		}
	});
	
	$edit_btn.on('click', function(){
		
		// No need for double checking here
		var me = $(this);
		var id = me.attr('user_id');
		GotoEditUser(id);
	});
};

$(function() {
	binds();
	rebindEverything();
});