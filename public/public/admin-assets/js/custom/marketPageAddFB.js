
  $(function() {
    $('.date-picker').datepicker( {
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'MM yy',
        onClose: function(dateText, inst) { 
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
    });
});


  function variantSelect(divId){
    var variant = $("#variant_"+divId).val();


    //$(".variant option[value='"+variant+"']").remove();

    if(variant!=''){
      $("#branchAdd_"+divId).show(); 
      
    }else{
      $("#branchAdd_"+divId).remove();  
    }
    $('.loader-section').css("display", "block");
    var html = '';

    var branch_url = baseUrl+'/market/focus-brand/get-branch';
    $.get(branch_url, {
      'branch_id': 1,'_token': '<?php echo csrf_token();?>',
      }, function(branch) {
        $('.loader-section').css("display", "none");
        $("#branch_"+divId+"_0")
                  .find('option')
                  .remove()
                  .end()
                  .append('<option value="">Select branch</option>');
          $.each(branch,function(i,o){
            $("#branch_"+divId+"_"+0).append('<option value="' + o.branch_id + '">' +o.branch_name+ '</option>');
          });
      });
    
  }

  function branchSelect(mainId,subId){
     var html = '';
    var branchId = $("#branch_"+mainId+"_"+subId).val();
    $('.loader-section').css("display", "block");
    var city_url = baseUrl+'/market/focus-brand/get-city';
    $.get(city_url, {
      'branch_id': branchId,'_token': '<?php echo csrf_token();?>',
      }, function(city) {
        $('.loader-section').css("display", "none");
        //console.log(city);

        $("#city_"+mainId+"_"+subId)
            .find('option')
            .remove()
            .end()
          $.each(city,function(i,o){
            $("#city_"+mainId+"_"+subId).append('<option value="' + o.city_id + '" selected>' +o.city_name+ '</option>');
          });
      });
  }

  function removeThis(divId,month_variant_id=0){
    if(month_variant_id>0){
      jConfirm('Continue?', 'Are you sure want to remove this?', function (ans) {
      if (ans){ 
        $('.loader-section').css("display", "block");
        var month_variant_remove_url = baseUrl+'/market/focus-brand/remove-month-variant';
        $.get(month_variant_remove_url, {
        'month_variant_id': month_variant_id,'_token': '<?php echo csrf_token();?>',
        }, function(res) {
          $('.loader-section').css("display", "none");
          if(res=='Y'){
            $("#mainDiv_"+divId).remove();
          }
        });
      }
    });
    }else{
      $("#mainDiv_"+divId).remove();  
    }
  }

  function removeThisBranch(mainId,divId,month_variant_branch_id=0){
    if(month_variant_branch_id>0){
      jConfirm('Continue?', 'Are you sure want to remove this?', function (ans) {
        if (ans){ 
          $('.loader-section').css("display", "block");
          var month_variant_branch_remove_url = baseUrl+'/market/focus-brand/remove-month-variant-branch';
          $.get(month_variant_branch_remove_url, {
          'month_variant_branch_id': month_variant_branch_id,'_token': '<?php echo csrf_token();?>',
          }, function(res) {
            $('.loader-section').css("display", "none");
            if(res=='Y'){
              $("#extraBranch_"+mainId+"_"+divId).remove();
            }
          });
        }
      });
    }else{
      $("#extraBranch_"+mainId+"_"+divId).remove();  
    }
  }

  $("body").on("click",".addExtraBranch", function(e){
          e.preventDefault();
          var mainId = $(this).attr("data-id");
          var id = $(this).attr("data-id1");
          id++;
          $(this).attr("data-id1", id);
          $('.loader-section').css("display", "block");

          var html = `<div class="row"  data-branchindex="`+id+`" id="extraBranch_`+mainId+`_`+id+`">
                                  <div class="col-md-5" id="branch_div_`+id+`">
                                      <label>Branch<span class="requireStar">*</span></label>
                                      <select name="branch[]" id="branch_`+mainId+`_`+id+`" class="branch form-control input-sm" onchange="branchSelect(`+mainId+`,`+id+`)">
            
                                              <option value="">No Branch Avilable</option>
                                          
                                      </select>
                                  </div>

                                  <div class="col-md-5">
                                      <label>City<span class="requireStar">*</span></label>
                                      <select multiple name="city[]" id="city_`+mainId+`_`+id+`" class="city form-control input-sm">
                                          <option value="">No City Avilable</option>
                                      </select>
                                  </div>

                                  <div class="col-md-2">
                                     <button type="button"  class="form-control btn btn-sm btn-danger removeBtn"  onclick="removeThisBranch(`+mainId+`,`+id+`)">Remove</button>
                                  </div>
                                </div>`;

          $("#branchAdd_"+mainId).append(html);

          var html = '';
          $('.loader-section').css("display", "block");
          var branch_url = baseUrl+'/market/focus-brand/get-branch';
          $.get(branch_url, {
            'branch_id': 1,'_token': '<?php echo csrf_token();?>',
            }, function(branch) {
              $('.loader-section').css("display", "none");
              $("#branch_"+mainId+"_"+id)
                  .find('option')
                  .remove()
                  .end()
                  .append('<option value="">Select branch</option>');
                $.each(branch,function(i,o){
                  $("#branch_"+mainId+"_"+id).append('<option value="' + o.branch_id + '">' +o.branch_name+ '</option>');
                  $('.loader-section').css("display", "none");
                });
            });

          });

  $("body").on("click","#addVariant", function(e){
          e.preventDefault();
          var id = $(this).attr("data-id");
          id++;
          $(this).attr("data-id", id);
          $('#no-rec').hide();
          $('.loader-section').css("display", "block");
          var variants_url = baseUrl+'/market/focus-brand/get-variants';
          $.get(variants_url, {
                  'variant_id': 1,'_token': '<?php echo csrf_token();?>',
                  }, function(variants) {
                    $('.loader-section').css("display", "none");
                   //console.log(variants);
                      var html =      `<div class="clearfix"></div>
                            <div class="row addedEachVariant" data-index="`+id+`" id="mainDiv_`+id+`">
                              
                              <div class="col-md-3" id="variant_div_`+id+`">
                                <div class="form-group">
                                  <label>Variant<span class="requireStar">*</span></label>
                                  <select name="variant[]" id="variant_`+id+`" class="form-control input-sm variant" onchange="variantSelect(`+id+`,0)">
                                  <option value="">Select Variant</option>`;

                                  $.each(variants,function(i,o){
                                    html += `<option value="`+o.variant_id+`">`+o.variant_name+`</option>`;
                                  });

                          html += `</select>
                                </div>
                              </div>

                              <div class="col-md-8" id="branchAdd_`+id+`" style="display: none;">

                                <div class="row" data-branchindex="0">
                                  <div class="col-md-5" id="branch_div_`+id+`">
                                      <label>Branch<span class="requireStar">*</span></label>
                                      <select name="branch[]" id="branch_`+id+`_0" class="form-control input-sm branch" onchange="branchSelect(`+id+`,0)">
                                          <option value="">No Branch avilable</option>                                          
                                      </select>
                                  </div>

                                  <div class="col-md-5">
                                      <label>City<span class="requireStar">*</span></label>
                                      <select multiple name="city[]" id="city_`+id+`_0" class="form-control input-sm city">
                                          <option value="">No City avilable</option> 
                                      </select>
                                  </div>

                                  <div class="col-md-2">
                                     <button type="button" data-id="`+id+`" data-id1="`+id+`"  class="form-control btn btn-sm btn-success removeBtn addExtraBranch">+ Add Branch</button>
                                  </div>
                                </div>
                              </div>
                              
                               <div class="col-md-1">
                                <button type="button" style="padding-right:70px"  class="form-control btn btn-sm btn-danger removeBtn"  onclick="removeThis(`+id+`)">Remove All</button>
                               </div>

                              </div>`;
                $("#addedEachVariant").append(html);
              });
        });



        function add_city_check(){
        $city = 0;
        $(".city").each(function( index ) {
            if(!$(this).commonCheck()){
                $city++;
            }
        });

        if($city > 0){
            return false;
        }
        else{
            return true;
        }
            
    }

    function add_branch_check(){
        $branch = 0;
        $(".branch").each(function( index ) {
            if(!$(this).commonCheck()){
                $branch++;
            }
        });

        if($branch > 0){
            return false;
        }
        else{
            return true;
        }
            
    }

    function add_variant_check(){
        $variant = 0;
        $(".variant").each(function( index ) {
            if(!$(this).commonCheck()){
                $variant++;
            }
        });

        if($variant > 0){
            return false;
        }
        else{
            return true;
        }
            
    }


        