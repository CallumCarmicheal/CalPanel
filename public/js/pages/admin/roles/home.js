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
			var route  = Laravel.RootURL + "admin/roles/" + query;

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

var $message_Modal;
var $message_Okay;

var $modal_Create;
var $create_Slug;
var $create_Name;
var $create_Desc;
var $create_Acpt;

function simplePopup(title, message, callback) {
	// Make sure its not open
	$message_Modal.modal('hide');

	var $header = $($message_Modal.find('.modal-title')[0]);
	var $body   = $($message_Modal.find('.modal-body')[0]);

	console.log($header, $body);

	$header.html(title);
	$body.html(message);

	// Set callbacks
	if(callback != null) {
		$message_Okay.off('click');
		$message_Okay.on('click', function () {
			$message_Modal.modal('hide');
			callback();
		});
	}

	$message_Modal.modal('show');
}

function GotoEditUser(id) {
	var url = Laravel.RootURL + "admin/role/" + id;
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

	$message_Modal      = $('#page_simple_modal');
	$message_Okay       = $('#page_simple_modal_ok');
	
	$modal_Create = $('#page_make_modal');
	$create_Slug  = $('#page_make_role_slug');
	$create_Name  = $('#page_make_role_name');
	$create_Desc  = $('#page_make_role_desc');
	$create_Acpt  = $('#page_make_accept');
	
	$('#page_addrole').on('click', function() {
		$modal_Create.modal('show');
		
		$create_Acpt.off('click');
		$create_Acpt.on('click', function() {
			// Values
			var slug = $create_Slug.val(), 
				name = $create_Name.val(), 
				desc = $create_Desc.val();
			
			var ascii = /^[a-z. ]*$/;
			
			if (isNullOrWhitespaced(name)) {
				simplePopup('Invalid name',
					'There is no name for the role you are trying to create, please name it!', null);
			} else if (isNullOrWhitespaced(desc)) {
				// Can always be changed later!
				simplePopup('Invalid description', 
					'There is no name for the role you are trying to create, please describe it!', null)
			}
			
			if ( !ascii.test( slug ) ) {
				simplePopup('Invalid slug', 
					'The slug contains invalid characters, the slug can only contain lowercase ' +
					'a-z and period\'s (.)!', null);
			} else if (slug.endsWith(".")) {
				simplePopup('Invalid slug', 'The role slug ends with a period charater (.), please remove the ' +
					'trailing period and try creating the role again! ', null)
			} else {
				var data = {
					_method: "patch"
				};
				
				// admin/roles/c/{slug}/{name}/{desc}
				var route = Laravel.RootURL + "admin/roles/c/";
				route += slug + "/";
				route += name + "/";
				route += desc + "/";

				$.ajax({
					url:  route, type: 'post',
					data: {_method: "patch"},
					success: function(r) { 
						var model = {
							success: false,
							message: "",
							id: 0
						}; model = r;
						
						if (model.success) {
							// Redirect to the model editor
							window.location = Laravel.RootURL + "admin/role/" + model.id;
						} else {
							simplePopup('Failed to create role', 
								'The role you were trying to create could not be made, ' +
								'Server Response: ' + model.message)
						}
					}
				});
			}
		});
	});
});