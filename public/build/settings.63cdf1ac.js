(self.webpackChunk=self.webpackChunk||[]).push([[5571],{49031:(t,e,n)=>{"use strict";n(73210);var a=n(1128),s=n(19755);s(document).on("change",".departementParDefaut",(function(t){s.ajax({url:Routing.generate("user_change_departement_defaut",{departement:s(this).val()}),method:"POST",success:function(t){(0,a.qX)("Mofification enregistrée !","success")},error:function(t){(0,a.qX)("Erreur lors de la sauvegarde de la modification !","danger")}})})),s(document).on("click","#valideNewpassword",(function(t){t.preventDefault();var e=s("#password_1").val().trim(),n=s("#password_2").val().trim(),i=s("#password_actuel").val().trim();""!==n&&""!==e&&""!==i?e!==n?(0,a.qX)("Les deux nouveaux mot de passe ne sont pas identique!","danger"):s.ajax({url:Routing.generate("user_change_password"),data:{passwd1:e,passwd2:n,passwdactuel:i},method:"POST",success:function(t){(0,a.qX)("Mofification de votre mot de passe effectuée !","success")},error:function(t){(0,a.qX)("Erreur lors de la modification du mot de passe !","danger")}}):(0,a.qX)("Tous les champs sont obligatoires pour la modification du mot de passe!","danger")}))},1128:(t,e,n)=>{"use strict";n.d(e,{qX:()=>p,xQ:()=>y,XQ:()=>b,zl:()=>g,FX:()=>k});n(3843),n(83710),n(9653),n(74916),n(15306),n(23123),n(73210);var a,s,i,o=n(19755),r=n.n(o),c=n(86455),u=n.n(c),l=n(19755),d=!1;function p(t,e){console.log("callout");var n=new Array;n.success="Succès",n.danger="Erreur",n.warning="Attention";var a='<div class="callout callout-'+e+'" role="alert">\n                    <button type="button" class="close" data-dismiss="callout" aria-label="Close">\n                        <span>&times;</span>\n                    </button>\n                    <h5>'+n[e]+"</h5>\n                    <p>"+t+"</p>\n                </div>";r()("#mainContent").prepend(a).slideDown("slow"),r()(".callout").delay(5e3).slideUp("slow")}a=r()(location).attr("pathname"),s=a.split("/"),i=2,"index.php"===s[1]&&s.length>1&&(i=3),"super-administration"===s[i]&&(i+=1),""===s[s.length-1]&&s.pop(),r()(".menu-item").removeClass("active"),r()("#menu-"+s[i]).addClass("active"),u().mixin({customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1}),r()(document).on("click",".supprimer",(function(t){t.preventDefault();var e=r()(this).attr("href"),n=r()(this).data("csrf");u().fire({title:"Confirmer la suppression ?",text:"L'opération ne pourra pas être annulée.",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Oui, je confirme",cancelButtonText:"Non, Annuler",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1}).then((function(t){t.value?r().ajax({url:e,type:"DELETE",data:{_token:n},success:function(t){t.hasOwnProperty("redirect")&&t.hasOwnProperty("url")?document.location.href=t.url:(r()("#ligne_"+t).closest("tr").remove(),p("Suppression effectuée avec succès","success"),u().fire({title:"Supprimé!",text:"L'enregistrement a été supprimé.",icon:"success",confirmButtonText:"OK",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1}))},error:function(t,e,n){u().fire({title:"Erreur lors de la suppression!",text:"Merci de renouveler l'opération",icon:"error",confirmButtonText:"OK",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1}),p("Erreur lors de la tentative de suppression","danger")}}):"cancel"===t.dismiss&&u().fire({title:"Cancelled",text:"OK! Tout est comme avant !",icon:"error",confirmButtonText:"OK",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1})}))}));var m="",f="text",v=!1;function h(t){var e=r()("#myedit-input-"+t).val();r().ajax({url:m.attr("href"),data:{field:m.data("field"),value:e,type:f},method:"POST",success:function(){m.html(e),r()("#myEdit-zone-"+t).replaceWith(m),v=!1}})}function y(t,e){var n={};return r().each(r()(t).data(),(function(t,a){if("provide"!=(t=t.replace(/-([a-z])/g,(function(t){return t[1].toUpperCase()})))){if(null!=e)switch(e[t]){case"bool":a=Boolean(a);break;case"num":a=Number(a);break;case"array":a=a.split(",")}n[t]=a}})),n}function b(t){t.removeClass("is-valid").addClass("is-invalid")}function g(t){t.removeClass("is-invalid").addClass("is-valid")}function k(t){t.removeClass("is-invalid").removeClass("is-valid")}r()(document).on("click",".myedit",(function(t){t.preventDefault(),m=r()(this);var e,n,a="";v=!0,void 0!==r()(this).data("type")&&(f=r()(this).data("type")),"select"===r()(this).data("type")||("textarea"===r()(this).data("type")?(e=r()(this),n=Date.now(),d=!0,a='<div id="myEdit-zone-'+n+'">\n                      <textarea rows="5" class="form-control" id="myedit-input-'+n+'">'+e.html().trim()+'</textarea>\n                      <span class="input-group-append">\n <button class="btn btn-success-outline myedit-valide" data-key="'+n+'"><i class="fas fa-check"></i></button>\n                        <button class="btn btn-danger-outline myedit-annule"  data-key="'+n+'"><i class="fas fa-times"></i></button>\n                      </span>\n                    </div>'):a=function(t){var e=Date.now();return'<div id="myEdit-zone-'+e+'" class="input-group">\n                      <input type="text" class="form-control" id="myedit-input-'+e+'" value="'+t.html().trim()+'" >\n                      <span class="input-group-append">\n <button class="btn btn-success-outline myedit-valide"  data-key="'+e+'"><i class="fas fa-check"></i></button>\n                        <button class="btn btn-danger-outline myedit-annule"  data-key="'+e+'"><i class="fas fa-times"></i></button>\n                      </span>\n                    </div>'}(r()(this))),r()(this).replaceWith(a),r()("#myedit-input").focus()})),r()(document).on("keyup","#myedit-input",(function(t){13===t.keyCode&&!1===d?h():27===t.keyCode&&r()("#myEdit-zone").replaceWith(m)})),r()(document).on("click",".myedit-valide",(function(t){d=!1,t.preventDefault(),h(r()(this).data("key"))})),r()(document).on("keypress",(function(t){!0===v&&!1===d&&13===t.which&&(t.preventDefault(),h(r()(this).data("key"))),!0===v&&!1===d&&27===t.which&&(t.preventDefault(),r()("#myEdit-zone-"+r()(this).data("key")).replaceWith(m))})),r()(document).on("click",".myedit-annule",(function(t){t.preventDefault(),r()("#myEdit-zone-"+r()(this).data("key")).replaceWith(m)})),l.fn.dataAttr=function(t,e){return r()(this)[0].getAttribute("data-"+t)||e},l.fn.hasDataAttr=function(t){return r()(this)[0].hasAttribute("data-"+t)}}},0,[[49031,3666,9755,2109,6208,9904]]]);