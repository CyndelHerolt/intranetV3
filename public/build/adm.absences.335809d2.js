(self.webpackChunkintranetv3=self.webpackChunkintranetv3||[]).push([[1158],{4040:(t,n,e)=>{"use strict";e(1128);var a=e(9755);a(document).on("change","#justifier_etudiant",(function(){a("#listeJustifie").empty().load(Routing.generate("administration_absences_liste_absence_etudiant",{etudiant:a(this).val()}))})),a(document).on("click",".checkAbsence",(function(t){var n=a(this).data("absence"),e=0;a(this).is(":checked")&&(e=1),a.ajax({url:Routing.generate("administration_absences_justifie",{absence:n,etat:e}),type:"GET",success:function(t){t?a("#ligne_"+n).removeClass("bg-pale-warning").addClass("bg-pale-success"):a("#ligne_"+n).removeClass("bg-pale-success").addClass("bg-pale-warning")}})}))},1128:(t,n,e)=>{"use strict";e.d(n,{qX:()=>m,xQ:()=>h,XQ:()=>v,zl:()=>g,FX:()=>C});e(4916),e(3123),e(3843),e(3710),e(3210),e(5306),e(9653);var a,i,s,o=e(9755),r=e.n(o),c=e(6455),u=e.n(c),l=e(9755),d=!1;function m(t,n){switch(n){case"success":window.umbrella.Toast.success(t);break;case"danger":window.umbrella.Toast.error(t);break;case"warning":window.umbrella.Toast.warning(t);break;case"info":window.umbrella.Toast.info(t)}}a=r()(location).attr("pathname"),i=a.split("/"),s=2,"index.php"===i[1]&&i.length>1&&(s=3),"super-administration"===i[s]&&(s+=1),""===i[i.length-1]&&i.pop(),r()(".menu-item").removeClass("active"),r()("#menu-"+i[s]).addClass("active"),u().mixin({customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1}),r()(document).on("click",".supprimer",(function(t){t.preventDefault();var n=r()(this).attr("href"),e=r()(this).data("csrf");u().fire({title:"Confirmer la suppression ?",text:"L'opération ne pourra pas être annulée.",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Oui, je confirme",cancelButtonText:"Non, Annuler",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1}).then((function(t){t.value?r().ajax({url:n,type:"DELETE",data:{_token:e},success:function(t){t.hasOwnProperty("redirect")&&t.hasOwnProperty("url")?document.location.href=t.url:(r()("#ligne_"+t).closest("tr").remove(),m("Suppression effectuée avec succès","success"),u().fire({title:"Supprimé!",text:"L'enregistrement a été supprimé.",icon:"success",confirmButtonText:"OK",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1}))},error:function(t,n,e){u().fire({title:"Erreur lors de la suppression!",text:"Merci de renouveler l'opération",icon:"error",confirmButtonText:"OK",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1}),m("Erreur lors de la tentative de suppression","danger")}}):"cancel"===t.dismiss&&u().fire({title:"Cancelled",text:"OK! Tout est comme avant !",icon:"error",confirmButtonText:"OK",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1})}))})),r()(document).on("click",".confirm-delete",(function(t){t.preventDefault();var n=r()(this).data("href"),e=r()(this).data("uuid"),a=r()(this).data("csrf");console.log(e),console.log(a),u().fire({title:"Confirmer la suppression ?",text:"L'opération ne pourra pas être annulée.",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Oui, je confirme",cancelButtonText:"Non, Annuler",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1}).then((function(t){t.value?r().ajax({url:Routing.generate(n,{uuid:e}),type:"DELETE",data:{_token:a},success:function(t){t.hasOwnProperty("redirect")&&t.hasOwnProperty("url")?document.location.href=t.url:(r()("#ligne_"+t).closest("tr").remove(),m("Suppression effectuée avec succès","success"),u().fire({title:"Supprimé!",text:"L'enregistrement a été supprimé.",icon:"success",confirmButtonText:"OK",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1}))},error:function(t,n,e){u().fire({title:"Erreur lors de la suppression!",text:"Merci de renouveler l'opération",icon:"error",confirmButtonText:"OK",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1}),m("Erreur lors de la tentative de suppression","danger")}}):"cancel"===t.dismiss&&u().fire({title:"Cancelled",text:"OK! Tout est comme avant !",icon:"error",confirmButtonText:"OK",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1})}))}));var p="",f="text",b=!1;function y(t){var n=r()("#myedit-input-"+t).val();r().ajax({url:p.attr("href"),data:{field:p.data("field"),value:n,type:f},method:"POST",success:function(){p.html(n),r()("#myEdit-zone-"+t).replaceWith(p),b=!1}})}function h(t,n){var e={};return r().each(r()(t).data(),(function(t,a){if("provide"!=(t=t.replace(/-([a-z])/g,(function(t){return t[1].toUpperCase()})))){if(null!=n)switch(n[t]){case"bool":a=Boolean(a);break;case"num":a=Number(a);break;case"array":a=a.split(",")}e[t]=a}})),e}function v(t){t.removeClass("is-valid").addClass("is-invalid")}function g(t){t.removeClass("is-invalid").addClass("is-valid")}function C(t){t.removeClass("is-invalid").removeClass("is-valid")}r()(document).on("click",".myedit",(function(t){t.preventDefault(),p=r()(this);var n,e,a="";b=!0,void 0!==r()(this).data("type")&&(f=r()(this).data("type")),"select"===r()(this).data("type")||("textarea"===r()(this).data("type")?(n=r()(this),e=Date.now(),d=!0,a='<div id="myEdit-zone-'+e+'">\n                      <textarea rows="5" class="form-control" id="myedit-input-'+e+'">'+n.html().trim()+'</textarea>\n                      <span class="input-group-append">\n <button class="btn btn-success-outline myedit-valide" data-key="'+e+'"><i class="fas fa-check"></i></button>\n                        <button class="btn btn-danger-outline myedit-annule"  data-key="'+e+'"><i class="fas fa-times"></i></button>\n                      </span>\n                    </div>'):a=function(t){var n=Date.now();return'<div id="myEdit-zone-'+n+'" class="input-group">\n                      <input type="text" class="form-control" id="myedit-input-'+n+'" value="'+t.html().trim()+'" >\n                      <span class="input-group-append">\n <button class="btn btn-success-outline myedit-valide"  data-key="'+n+'"><i class="fas fa-check"></i></button>\n                        <button class="btn btn-danger-outline myedit-annule"  data-key="'+n+'"><i class="fas fa-times"></i></button>\n                      </span>\n                    </div>'}(r()(this))),r()(this).replaceWith(a),r()("#myedit-input").focus()})),r()(document).on("keyup","#myedit-input",(function(t){13===t.keyCode&&!1===d?y():27===t.keyCode&&r()("#myEdit-zone").replaceWith(p)})),r()(document).on("click",".myedit-valide",(function(t){d=!1,t.preventDefault(),y(r()(this).data("key"))})),r()(document).on("keypress",(function(t){!0===b&&!1===d&&13===t.which&&(t.preventDefault(),y(r()(this).data("key"))),!0===b&&!1===d&&27===t.which&&(t.preventDefault(),r()("#myEdit-zone-"+r()(this).data("key")).replaceWith(p))})),r()(document).on("click",".myedit-annule",(function(t){t.preventDefault(),r()("#myEdit-zone-"+r()(this).data("key")).replaceWith(p)})),l.fn.dataAttr=function(t,n){return r()(this)[0].getAttribute("data-"+t)||n},l.fn.hasDataAttr=function(t){return r()(this)[0].hasAttribute("data-"+t)}}},t=>{"use strict";t.O(0,[9755,2109,6208,9904],(()=>{return n=4040,t(t.s=n);var n}));t.O()}]);