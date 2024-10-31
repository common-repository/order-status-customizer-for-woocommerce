(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

    function showInfoBox()
    {
       $('#div_info_box').show();
    }

    // Add Color Picker to all inputs that have 'color-field' class
    $(function() 
    { 
        //set the initial data
        setTimeout(function(){ 
           
           $('#span_preview').html( $('#title').val() );
           $('#div_preview mark').css({'background-color': $('#input_nos_background_color').val(),
                                       'color': $('#input_nos_color').val()
                                      });
           
           
        }, 1000);
        
        
        
        $('.color-field').wpColorPicker({
            change: function(event, ui) {
                 
                 $('#div_preview mark').css({'background-color': $('#input_nos_background_color').val(),
                             'color': $('#input_nos_color').val()
                            });
                 
            }
        });
        
        function toggle_action_fields()
        {
            var val = $('#select_action').val();
        
            $('.action-pane').hide();
            $('#div_action_' + val).show();
        }
        
        
        $('#select_action').change(function(){
            
            toggle_action_fields();
        
        });
        
        
        $('#a_available_tags').click(function(){
           
           $('#div_info_box').toggle();
           
        });
        
        $('#a_close_info_box').click(function(){
           
           $('#div_info_box').hide();
           
        });
        
        $('#title').keyup(function(){
           
           $('#span_preview').html( $('#title').val() );
           
           $('#div_preview mark').css({'background-color': $('#input_nos_background_color').val(),
                                       'color': $('#input_nos_color').val()
                                      });
           
        });
        
        
        $('#input_nos_background_color').on('input', function(){
             
             $('#div_preview mark').css({'background-color': $('#input_nos_background_color').val(),
                                         'color': $('#input_nos_color').val()
                                        });
             
        });
        
        $('#input_nos_color').on('input', function(){
             
             $('#div_preview mark').css({'background-color': $('#input_nos_background_color').val(),
                                         'color': $('#input_nos_color').val()
                                        });
             
        });
        
        

        toggle_action_fields();
        
    });
    
})( jQuery );
