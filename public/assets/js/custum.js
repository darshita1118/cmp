function getProgramByDept(dept='', prog = ''){
    if(dept !== ''){
        $.ajax({
            url: base_url+'/helper/get-program-by-dept',
            type: 'post',
            data: {'deptm':dept},
            dataType: 'JSON',
            async: false,
            success: function (result) {
                //console.log(result)
                if (result.isOk == false){
                    showFire('error', `Something Went Wrong`);
                }else{
                    $('#programnameid').find('option').remove().end().append('<option value="">-- Select Program --</option>');
                    var programs = result.data
                    for (let i = 0; i < programs.length; i++) {
                        if(prog === programs[i].id){
                            $('#programnameid').append($("<option/>", {
                                value: programs[i].id,
                                text: programs[i].name,
                                selected: 'selected'
                            }));
                        }else{
                            $('#programnameid').append($("<option/>", {
                                value: programs[i].id,
                                text: programs[i].name,
                            }));
                        }
                        
                    }   
                    // remove selected option all 
                    // add --select-- option
                    // start for loop
                    // and append to program
                    console.log(result.data)
                }
            },
            error: function(){
                //console.log(result)
                showFire(`error`, `Something Went Wrong on Server Side`);
            }
            
        });
    }else{
        $('#programnameid').find('option').remove().end().append('<option value="">-- Select Program --</option>');
    }
    
}

function getInfo(statusType, m='', d='', t='') {
    $('#statusinfo').val(statusType);
    if(statusType === '0'){
        $('#getExtraField').html('');
        return 
    }else{

        $.ajax({
            url: base_url+'/helper/getInfoForm/'+statusType,
            type: 'POST',
            data: {'m':m,'t':t,'d':d},
            async: false,
            success: function (result) {
                //console.log(result)
                $('#getExtraField').html('');
                $('#getExtraField').html(result);
            },
            error: function(){
                //console.log(result)
                showFire(`error`, `Something Went Wrong on Server Side`);
            }
            
        });
        return
    }
}
function getScore(para, type) {
    $('#score'+type).val(para);
    return 
}

function getInfoProfile(statusType, m='', d='', t='') {
    $('#statusinfo').val(statusType);
    if(statusType === '0'){
        $('#getExtraField').html('');
        return 
    }else{

        $.ajax({
            url: base_url+'/helper/getInfoFormProfile/'+statusType,
            type: 'POST',
            data: {'m':m,'t':t,'d':d},
            async: false,
            success: function (result) {
                //console.log(result)
                $('#getExtraField').html('');
                $('#getExtraField').html(result);
            },
            error: function(){
                //console.log(result)
                showFire(`error`, `Something Went Wrong on Server Side`);
            }
            
        });
        return
    }
}
