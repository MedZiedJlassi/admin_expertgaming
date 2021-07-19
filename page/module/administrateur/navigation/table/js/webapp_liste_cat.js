/**
 * DataTables Basic
 */

$(function () {
  'use strict';
  $(document).ready(function(){
  var dt_basic_table = $('.datatables-basic'),
    dt_date_table = $('.dt-date'),
    assetPath = '../app-assets/';
  
  var form_comm = $('#form_comm');

  

  // DataTable with buttons
  // --------------------------------------------------------------------
  if (dt_basic_table.length) {
    var dt_basic = dt_basic_table.DataTable({
      ajax: 'table/php/data_liste_cat.php?job=get_liste_cat',
      columns: [    
        { data: 'responsive_id' },
        { data: 'id' },
        { data: 'id' }, // used for sorting so will hide this column    
        { data: 'full_name' },
        { data: 'titre' },
        { data: 'start_date' },
        { data: 'status' },
        { data: 'Actions' }
      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
          orderable: false,
          responsivePriority: 2,
          targets: 0
        },
        {
          targets: 2,
          visible: false
        },
        {
          // Avatar image/badge, Name and post
          targets: 3,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            var $user_img = full['avatar'],
              $name = full['full_name'],
              $post = full['post'];
            if ($user_img) {
              // For Avatar image
              var $output =
                '<img src="' + assetPath + 'images/portrait/small/man.png" alt="Avatar" width="32" height="32">';
            } else {
              // For Avatar badge
              var stateNum = full['status'];
              var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
              var $state = states[stateNum],
                $name = full['full_name'],
                $initials = $name.match(/\b\w/g) || [];
              $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
              $output = '<span class="avatar-content">' + $initials + '</span>';
            }

            var colorClass = $user_img === '' ? ' bg-light-' + $state + ' ' : '';
            // Creates full output for row
            var $row_output =
              '<div class="d-flex  align-items-center">' +'<div class="avatar ' +
              colorClass +
              ' mr-1">' +
              $output +
              '</div>' +
              '<div class="d-flex flex-column">' +
              '<span class="emp_name text-truncate font-weight-bold">' +
              $name +
              '</span>' +
              '<small class="emp_post text-truncate text-muted">' +
              $post +
              '</small>' +
              '</div>' +
              '</div>';
            return $row_output;
          }
        },
        {
          responsivePriority: 1,
          targets: 4
        }
      ],
      order: [[2, 'desc']],
      dom:
        '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-right"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      displayLength: 7,
      lengthMenu: [7, 10, 25, 50, 75, 100],
      buttons: [
        {
          extend: 'collection',
          className: 'btn btn-outline-secondary dropdown-toggle mr-0',
          text: feather.icons['share'].toSvg({ class: 'font-small-4 mr-50' }) + 'Export',
          buttons: [
            {
              extend: 'print',
              text: feather.icons['printer'].toSvg({ class: 'font-small-4 mr-50' }) + 'Print',
              className: 'dropdown-item',
              exportOptions: { columns: [3, 4, 5, 6, 7] }
            },
            {
              extend: 'csv',
              text: feather.icons['file-text'].toSvg({ class: 'font-small-4 mr-50' }) + 'Csv',
              className: 'dropdown-item',
              exportOptions: { columns: [3, 4, 5, 6, 7] }
            },
            {
              extend: 'excel',
              text: feather.icons['file'].toSvg({ class: 'font-small-4 mr-50' }) + 'Excel',
              className: 'dropdown-item',
              exportOptions: { columns: [3, 4, 5, 6, 7] }
            },
            {
              extend: 'pdf',
              text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 mr-50' }) + 'Pdf',
              className: 'dropdown-item',
              exportOptions: { columns: [3, 4, 5, 6, 7] }
            },
            {
              extend: 'copy',
              text: feather.icons['copy'].toSvg({ class: 'font-small-4 mr-50' }) + 'Copy',
              className: 'dropdown-item',
              exportOptions: { columns: [3, 4, 5, 6, 7] }
            }
          ],
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
            $(node).parent().removeClass('btn-group');
            setTimeout(function () {
              $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
            }, 50);
          }
        }/*,
        {
          text: feather.icons['plus'].toSvg({ class: 'mr-50 font-small-4' }) + 'Ecrire un article',
          className: 'create-new btn btn-primary',
          attr: {
            'href': 'http://www.google.fr',
          },
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
          }
        }*/
      ],
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Details of ' + data['full_name'];
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              console.log(columns);
              return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                ? '<tr data-dt-row="' +
                    col.rowIndex +
                    '" data-dt-column="' +
                    col.columnIndex +
                    '">' +
                    '<td>' +
                    col.title +
                    ':' +
                    '</td> ' +
                    '<td>' +
                    col.data +
                    '</td>' +
                    '</tr>'
                : '';
            }).join('');

            return data ? $('<table class="table"/>').append(data) : false;
          }
        }
      },
      language: {
        paginate: {
          // remove previous & next text from pagination
          previous: '&nbsp;',
          next: '&nbsp;',
          

        },
        info: "Affichage page _PAGE_ jusqu'à _PAGES_",
        lengthMenu: "Affichage _MENU_ lignes par page",
        search: "Recherche :",
        zeroRecords: "Aucunes données disponibles !",
        infoEmpty: "Aucun enregistrement disponible",
        infoFiltered: "(filtré depuis _MAX_ total des enregistrements)"
      }
    });
    $('div.head-label').html('<h6 class="mb-0">Liste des catégories du site WEB</h6>');
  
  }
  // Flat Date picker
  if (dt_date_table.length) {
    dt_date_table.flatpickr({
      monthSelectorType: 'static',
      dateFormat: 'm/d/Y'
    });
  }

  

  // Delete Record
  $(document).on('click', '#delete-record', function (e) {
    Swal.fire({
		  title: 'Êtes-vous sûr ?',
		  text: "Vous ne pourrez pas annuler cela !",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Oui, supprimez-le !',
		  confirmButtonClass: 'btn btn-primary',
		  cancelButtonClass: 'btn btn-danger ml-1',
		  buttonsStyling: false,
		}).then(function (result) {
		  if (result.value) {
							e.preventDefault();
							var id      = $("#delete-record").data('id');
							var name      = $("#delete-record").data('name');
							var request = $.ajax({
							url:          'table/php/data_liste_cat.php?job=del_cat&id=' + id,
							cache:        false,
							dataType:     'json',
							contentType:  'application/json; charset=utf-8',
							type:         'get'
							});
							
							request.done(function(output){
								if (output.result == 'success'){
									  Swal.fire({
										  type: "success",
										  title: 'Supprimée!',
										  text: "Catégorie '" + name + "' effacé avec succès.",
										  confirmButtonClass: 'btn btn-success',
										});
                    dt_basic.ajax.reload();
								} else {
									Swal.fire({
									  title: 'Annulée',
									  text: "Une erreur s'est produite lors de l'enregistrement " + textStatus,
									  type: 'error',
									  confirmButtonClass: 'btn btn-success',
									})
								}
							});
							request.fail(function(jqXHR, textStatus){
								Swal.fire({
								  title: 'Annulée',
								  text: "Une erreur s'est produite lorsxxx de l'enregistrement " + textStatus,
								  type: 'error',
								  confirmButtonClass: 'btn btn-success',
								})
							})
			
		  }
		  else if (result.dismiss === Swal.DismissReason.cancel) {
			  
			Swal.fire({
			  title: 'Annulée',
			  text: 'Votre fichier est en sécurité',
			  type: 'error',
			  confirmButtonClass: 'btn btn-success',
			})
		  }
		})
  }); 

  $(document).on('submit', '#jquery-val-form.add', function(){
	  			
      var form_data = $('#jquery-val-form').serialize();
	  
      var request   = $.ajax({
        url:          'table/php/data_liste_cat.php?job=add_cat',
        cache:        false,
        data:         form_data,
        dataType:     'json',
        contentType:  'application/json; charset=utf-8',
        type:         'get'
      });
      
      
	  
      request.done(function(output){
        if (output.result == 'success'){         

          
          window.location.replace("liste_rubrique_cat.php");
			
		  
        } else {
          Swal.fire({
            title: "ERREUR !",
            text: "ALERTE : " + output.message,
            type: "error",
            confirmButtonClass: 'btn btn-primary',
            buttonsStyling: false,
          });
        }

      });
	  
      request.fail(function(jqXHR, textStatus){
        Swal.fire({
          title: "ERREUR !",
          text: "ALERTE : " + output.message,
          type: "error",
          confirmButtonClass: 'btn btn-primary',
          buttonsStyling: false,
        });  
      });
  });


  $(document).on('submit', '#jquery-val-form.edit', function(e){

		  var id        = $('#jquery-val-form').attr('data-id');
		  var form_data = $('#jquery-val-form').serialize();

		  var request   = $.ajax({
			url:          'table/php/data_liste_cat.php?job=edit_cat&id=' + id,
			cache:        true,
			data:         form_data,
			dataType:     'json',
			contentType:  'application/json; charset=utf-8',
			type:         'get'
		  });

		  request.done(function(output){

        if (output.result == 'success'){

          
          window.location.replace("liste_rubrique_cat.php");
          
                
        } else {
          
            Swal.fire({
            title: 'Annulée',
            text: 'La demande de modification a échoué : ' + textStatus,
            type: 'error',
            confirmButtonClass: 'btn btn-success',
          })
          
        }
		  });
		  
		  request.fail(function(jqXHR, textStatus){
			  
			  Swal.fire({
				  title: 'Annulée',
				  text: 'La demande de modification a échoué : ' + textStatus,
				  type: 'error',
				  confirmButtonClass: 'btn btn-success',
				})
				
		  });
		
	});


});
});