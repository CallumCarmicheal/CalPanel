Page = {
	Name: "Admin: Roles -> Edit",
	
	Role: {
		Slug:       "",
		Name:       "",
		IsHighest:  false
	},
	
	Lib: {
		HideRow: function($row) {
			$row.fadeOut(1000, function(){
				$row.remove();
			});
		},
	},

	API: {

	}
};

function onPermsSubmit() {
	var data = {
		_method: 'patch',
		perms: [ ]
	};
	
	/* var perm = {
		id: '',
		en: true 
	} */
	
	$('.tog_perm').each(function( i, e ){
		var $e  = $(e);
		var chk  = $e.is(':checked') ? 1 : 0;
		var pid  = $e.attr('pid');
		data.perms.push({id: pid, en: chk});
	});
	
	console.log("Data: ", data);
	
	// Use the modal
	$perms_modal_AYS.modal('show');

	$perms_AYS_PInfo.html(Page.Role.Name + " [slug:" + Page.Role.Slug + "]");

	$perms_Btn.off('click');
	$perms_Btn.on('click', function() {
		var route = Laravel.RootURL + "admin/role/";
		route += Page.Role.Slug;
		
		// Post the data
		$.ajax({
			url:  route, type: 'post',
			data: data,
			success: function(r) {
				$perms_modal_AYS.modal('hide');
				
				console.log(r);
				
				/*var model = {
					success: bool	
				};*/
				
				if (r.success) {
					$perms_modal_SUC.modal('show');
					$perms_SUC_Refsh.off('click');
					$perms_SUC_Refsh.on('click', function(){
						window.location.reload();
					});

					$perms_SUC_Cont.off('click');
					$perms_SUC_Cont.on('click', function(){
						
						$.each(data.perms, function(x, obj) {
							var model = {
								id: 0,
								en: 0-1
							}; model = obj;
							
							$elem = $("#tog_perm_" + model.id);
							$elem.attr("checked", model.en == 1 ? true : false);
						});
					});
				}
			}
		});
	});
}

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

function yesnoPopup(title, message, cbYes, cbNo) {
	var $modal = $yesno_Modal;
	
	// Make sure its not open
	$modal.modal('hide');

	var $header = $($modal.find('.modal-title')[0]);
	var $body   = $($modal.find('.modal-body')[0]);

	console.log($header, $body);

	$header.html(title);
	$body.html(message);

	// Set callbacks
	if(cbYes != null) {
		$yesno_Yes.off('click');
		$yesno_Yes.on('click', function() {
			$modal.modal('hide');
			cbYes();
		});
	}
	
	if (cbNo != null) {
		$yesno_No.off('click');
		$yesno_No.on('click', function() {
			$modal.modal('hide');
			cbNo();
		});
	}

	$modal.modal('show');
}

function setAllPermissions(state) {
	$('.tog_perm').each(function( i, e ){
		var $e = $(e);
		$e.prop('checked', state);
	});
}

function toggleAllPermissions() {
	$('.tog_perm').each(function( i, e ){
		var $e = $(e);
		var state = !$e.is(':checked');
		$e.prop('checked', state);
	});
}

function addUser(id, extra) {
	var data = {
		_method: 'patch',
		id: id
	};

	// admin/role/{slug}/u/{email}
	var route = Laravel.RootURL + "admin/role/";
	route += Page.Role.Slug;
	route += "/u/";
	route += id;

	console.log(route);

	$.ajax({
		url:  route, type: 'post',
		data: data,
		success: function(r) {
			var model = {
				success: true,
				message: ""
			};

			model = r;

			if(model.success) {
				users_QueryUserList(uGetQry());
				simplePopup(
					'Added the user ' + Page.Role.Name,
					'The user ' + name + '['+extra+']' + '<br>' +
					'To the role ' + Page.Role.Name +
					" [slug:" + Page.Role.Slug + "]<br><br>" + 
					'Please refresh the page to see the changed users (in "Currently in" users list)',
					null);
			} else {
				simplePopup(
					'Error while adding the user',
					'The user ' + name + '['+extra+']' + '<br>' +
					'Could not be removed from the role ' + Page.Role.Name + " [slug:" + Page.Role.Slug + "]" + 
					"<br><br>Server Message: " + model.message,
					null);
			}
		}
	});
}

function deleteUser(id, name, extra) {
	yesnoPopup(
		'Are you sure?',
		'Are you sure you want to delete the user ' + name + ' with the attributes: ' + extra,
		function() {

			var data = {
				_method: 'delete',
				id: id
			};

			// admin/role/{slug}/u/{email}
			var route = Laravel.RootURL + "admin/role/";
			route += Page.Role.Slug;
			route += "/u/";
			route += id;

			console.log(route);

			$.ajax({
				url:  route, type: 'post',
				data: data,
				success: function(r) {
					var model = {
						success: true,
						message: ""
					};

					model = r;

					if(model.success) {
						simplePopup(
							'Removed the user from ' + Page.Role.Name,
							'The user ' + name + ' with the attributes: ' + extra
							+ ' has been removed from the role ' + Page.Role.Name +
							" [slug:" + Page.Role.Slug + "]",
							function() { Page.Lib.HideRow($parent); });
					} else {
						simplePopup(
							'Error while removing user',
							'The user ' + name + ' with the attributes: ' + extra
							+ ' could not be removed from the role ' + Page.Role.Name +
							" [slug:" + Page.Role.Slug + "]" + "<br><br>Server Message: " + model.message,
							null);
					}
				}
			});
		}, null
	);
}


// Much variables 
// Many functionality!

var $permsAdd           = null;
var $perms_modal_AYS    = null;
var $perms_AYS_PInfo    = null;
var $perms_Btn          = null;
var $perms_AYS_Submt    = null;
var $perms_modal_SUC    = null;
var $perms_SUC_Refsh    = null;
var $perms_SUC_Cont     = null;
var $perms_BTN_EnAll    = null;
var $perms_BTN_DsAll    = null;
var $perms_BTN_Toggl    = null;

var $message_Modal      = null;
var $message_Okay       = null;

var $yesno_Modal        = null;
var $yesno_Yes          = null;
var $yesno_No           = null;

var $users_add_btn 		= null;
var $users_modal		= null;
var $users_modal_rts	= null;
var $users_modal_qry	= null;
var $users_modal_lst 	= null;

var usr_RespCurrent 	=0;
var usr_RestLatest		=0;

function uGetQry() {
	return $users_modal_qry.val();
}

function users_QueryUserList(query, callback=null) {
	if(query == null || query == "")
		query = "*";

	console.log("Querying Users ("+query+") with Index: " +(usr_RespCurrent + 1));

	if (usr_RespCurrent >= 2147483640) 
		usr_RespCurrent = 0;

	var qIndex = ++usr_RestLatest;
	var route  = Laravel.RootURL + "admin/roles/u/" + Page.Role.Slug + "/"+ query;

	$.ajax({
	    url:  route,
	    type: 'post',
	    success: function(r) {
	    	var show = (usr_RestLatest == qIndex);

	    	if (!show) {
	    		if (usr_RespCurrent < qIndex) {
	    			usr_RespCurrent = qIndex;
	    			show = true;
	    		}
	    	}

	    	if (show) {
	    		$users_modal_lst.empty();
	    		$users_modal_lst.html(r);
			    rebindUserQueryItems();
	    	} 

	    	if(callback != null)
	    		callback();
	    }
	});
}

function rebindUserQueryItems() {
	$('.code_page-users-add').on('click', function() {
		// get id
		$this   = $(this);
		id      = $this.attr('user_id');
		
		$parent = $($($($this.parent()).parent())[0]);
		name    = $($parent.find('.title')[0]).html().trim();
		extra   = $($parent.find('.caption')[0]).html().trim();

		// Create a yes no dialog
		yesnoPopup(
			'Add user to ' + Page.Role.Name + ' ?', 

			"You are you sure you want to add " 
				+ name + " (id:"+id+") [" + extra + "] to the role " + 
				Page.Role.Name + " [slug:" + Page.Role.Slug
				 + "] ?", 

			function() {
				addUser(id, name, extra);
			}, null);
	});


	// Touch support
	
}

function usersIsRealTime() {
	return $users_modal_rts.is(':checked');
}

var users_OpenedQL  = false;
var users_OpeningQL = false;
var users_Selected  = null;
function setUserBinds() {

	/* Add Users Modal */ {
		// Objects
		$users_add_btn   = $('#page_users_btn_add');
		$users_modal     = $('#page_users_add_modal');
		$users_modal_add = $('#page_users_modal_add');
		$users_modal_rts = $('#page_users_modal_rts');
		$users_modal_qry = $('#page_users_modal_qry');
		$users_modal_lst = $('#page_users_modal_lst');

		// Show modal
		$users_add_btn.on('click', function() {
			if(!users_OpeningQL) {
				users_OpenedQL = true;
				users_QueryUserList("*", function() {
					users_OpeningQL = false;

					// Show the modal
					$users_modal.modal();
				});
			} else {
				if (!users_OpeningQL) 
					$users_modal.modal();
			}
		});

		// Search the users
		$users_modal_qry.keyup(function(e) {
			if (usersIsRealTime() || e.which == 13)
				users_QueryUserList(uGetQry());
		});
	} 

	/* Remove Users */ {
		$('.page-user-btn-rm').on('click', function() {
			$this   = $(this);
			id      = $this.attr('user_id');
			
			$parent = $($($($this.parent()).parent())[0]);
			name    = $($parent.find('.title')[0]).html().trim();
			extra   = $($parent.find('.caption')[0]).html().trim();
			
			deleteUser(id, name, extra);
		});
		
		// Touch support
		$('.page-edit-user-tab-rm').on('click', function() {
			if (Laravel.Website.isTouch()) {
				$parent     = $(this);
				$ide        = $($parent.find('.page-user-btn')[0]);
				id          = $ide.attr('user_id');
				name        = $($parent.find('.title')[0]).html().trim();
				extra       = $($parent.find('.caption')[0]).html().trim();
				deleteUser(id, name, extra);
			}
		});
	}
}

function setPermsBinds() {
	$perms_modal_AYS    = $('#page_perms_areyousure');
	$perms_AYS_PInfo    = $('#page_perms_areyousure_perminfo');
	$perms_Btn          = $('#page_perms_areyousure_btn');
	$perms_AYS_Submt    = $('#page_submit_perms');
	
	$perms_modal_SUC    = $('#page_perms_success');
	$perms_SUC_Refsh    = $('#page_perms_success_refresh');
	$perms_SUC_Cont     = $('#page_perms_success_dismiss');

	$perms_BTN_EnAll    = $('#page_perms_btn_enall');
	$perms_BTN_DsAll    = $('#page_perms_btn_dsall');
	$perms_BTN_Toggl    = $('#page_perms_btn_toggle');
}

function setModalBinds() {
	$message_Modal      = $('#page_simple_modal');
	$message_Okay       = $('#page_simple_modal_ok');

	$yesno_Modal        = $('#page_yn_modal');
	$yesno_Yes          = $('#page_yn_modal_yes');
	$yesno_No           = $('#page_yn_modal_no');
}

$(function() {
	setUserBinds();
	setPermsBinds();
	setModalBinds();

	$('#page_delete_role').on('click', function() {
		var topic = 'Delete ' + Page.Role.Name;
		var desc  = 'Are you sure you want to delete this role? ' + Page.Role.Name + 
					" [slug:" + Page.Role.Slug + "]" + "\n";
 
		yesnoPopup(topic, desc, 
		function() {
			// Delete the role

			var data = { _method: "delete" };
			var route = Laravel.RootURL + "admin/role/" + Page.Role.Slug;

			$.ajax({
				url:  route, type: 'post',
				data: data, success: function(r) {
					var model = {
						success: true,
						message: ""
					}; model = r;

					if (model.success) {
						window.location = Laravel.RootURL + "admin/roles";
					} else {
						simplePopup(
							'Failed to delete role',
							'There was a error when deleting the role. Server Response: ' + model.message);
					}
				}
			});
		}, null);
	});
	
	$perms_BTN_EnAll.on('click', function() { setAllPermissions(true); });
	$perms_BTN_DsAll.on('click', function() { setAllPermissions(false); });
	$perms_BTN_Toggl.on('click', toggleAllPermissions);
	$perms_AYS_Submt.on('click', onPermsSubmit);

	$('.editbtn').on('click', function() {

		var $this = $(this);
		var isSave = false;
		isSave = !($this.html() == "Edit");

		// text-editor
		// label-display
		var $master = $($($this.parent()).parent());
		var $dInput = $($master.find('.text-editor')[0]);
		var $tInput = $($dInput.find('input')[0]);
		var $editbn = $($master.find('.editbtn')[0]);

		if(isSave) {
			// add teh attr (readonly)
			// upload the new selection to the server
			$tInput.attr('readonly', true);
			$editbn.html("Edit");
		} else {
			// remove the attr (readonly)
			$tInput.removeAttr('readonly');
			$editbn.html("Save");
		}

		var savetype = $this.attr('savetype');
	});
});