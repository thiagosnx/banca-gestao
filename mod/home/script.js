const url = "/bnc-gst/mod/sys/" 

function getFormData(form){
    var unindexed_array = form.serializeArray();
    var indexed_array = {};
    let e = 0;
    let campos = {};
    let names = [];

    //console.log(unindexed_array);
    $.map(unindexed_array, function(n, i){

        let vl = null;
        let d = form.find('[name="' + n['name'] + '"]').each(function(){

            let o = $(this).data('obg');

            if(o == 1){

                let tg = $(this).prop("tagName");
                let lg = $(this).attr('title') == undefined ? $(this).attr('placeholder') : $(this).attr('title');

                switch (tg) {
                    case 'TEXTAREA':
                        if(n['value'] == "" || n['value'] == undefined){
                            campos[e] = lg;
                            $(this).parents('.form-group').addClass('has-error');
                            e++;
                        } else {
                            $(this).parents('.form-group').removeClass('has-error');
                        }
                        vl = n['value'];
                        break;

                    case 'SELECT':
                        if(n['value'] == "" || n['value'] == undefined){
                            campos[e] = lg;
                            $(this).parents('.form-group').addClass('has-error');
                            e++;
                        } else {
                            $(this).parents('.form-group').removeClass('has-error');
                        }
                        vl = n['value'];
                        break;

                    case 'INPUT':
                        let tp = $(this).prop('type');
                        switch (tp) {
                            case 'text':
                                let ct = $(this).data('tipo');
                                switch (ct) {
                                    case 't':
                                        if(n['value'] == "" || n['value'] == undefined){
                                            campos[e] = lg;
                                            $(this).parents('.form-group').addClass('has-error');
                                            e++;
                                        } else {
                                            $(this).parents('.form-group').removeClass('has-error');
                                        }
                                        break;

                                    case 'n':
                                        if(n['value'] <= 0 || n['value'] == undefined){
                                            campos[e] = lg;
                                            $(this).parents('.form-group').addClass('has-error');
                                            e++;
                                        } else {
                                            $(this).parents('.form-group').removeClass('has-error');
                                        }
                                        break;

                                    default:
                                        campos[e] = lg;
                                        $(this).parents('.form-group').addClass('has-error');
                                        e++;
                                        break;
                                }
                                vl = n['value'];
                                break;
                            case 'checkbox':
                                if($(this).is(':checked')){
                                    vl = 1;
                                } else {
                                    vl = 0;
                                }
                                break;
                        }
                        break;
                
                    default:
                        campos[e] = lg;
                        $(this).parents('.form-group').addClass('has-error');
                        e++;
                        vl = n['value'];
                        break;
                }
            } else {
                vl = n['value'];
            }
        });

        let igual = names.find( e => e == n['name']) == n['name'] ? true : false;

        if(igual){
            indexed_array[n['name']] = indexed_array[n['name']] + ',' + vl;
            console.log('item: ' + indexed_array[n['name']]);
        } else {
            indexed_array[n['name']] = vl;
        }
        names.push(n['name']);

        //console.log(n);
        //console.log(n['name'] + " > " + n['data-obj']);
    });
    indexed_array['erros'] = e;
    if(e > 0){
        indexed_array['campos'] = campos;
    }
    return indexed_array;
}


$(function(){
    $(document).on('click', '#bt-st-nwfrm', function(){
        let data = getFormData($('form#nwGst'));
        let formData = $('#nwGst').serialize();
        $.ajax({
            url : url,
            type: 'post',
            dataType: 'json',
            data: data,
            success: function(res){
                console.log(res);
            },
            error: function(err){
                console.error(err);
                console.log(data);
            }
    
        })
    })
})


    // let dataForm = $('#nwGst').serialize();
