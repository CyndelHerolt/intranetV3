(self.webpackChunk=self.webpackChunk||[]).push([[6853],{31778:(t,n,e)=>{"use strict";var a=e(1128),i=e(19755);i(document).on("click",".justificatif-accepte",(function(t){var n=i(this).data("justificatif");i.ajax({url:Routing.generate("administration_absence_justificatif_change_etat",{uuid:n,etat:"A"}),success:function(t){var e=i(".bx_"+n),s=e.parent();e.remove();var r='<a href="#" class="btn btn-success btn-outline"><i class="ti-check"></i>Accepté</a>';r=r+'<button data-justificatif="'+n+'"\nclass="btn btn-danger btn-outline btn-square justificatif-annuler bx_'+n+'" data-provide="tooltip" data-placement="bottom"\ntitle="Annuler"><i\nclass="material-icons">undo</i></button>',s.prepend(r),(0,a.qX)("Justificatif d'absence validé !","success")},error:function(t){(0,a.qX)("Une erreur est survenue !","danger")}})})),i(document).on("click",".justificatif-refuse",(function(t){var n=i(this).data("justificatif");i.ajax({url:Routing.generate("administration_absence_justificatif_change_etat",{uuid:n,etat:"R"}),success:function(t){var e=i(".bx_"+n),s=e.parent();e.remove();var r='<a href="#" class="btn btn-warning btn-outline"><i class="ti-check"></i>Refusé</a>';r=r+'<button data-justificatif="'+n+'"\nclass="btn btn-danger btn-outline btn-square justificatif-annuler bx_'+n+'" data-provide="tooltip" data-placement="bottom"\ntitle="Annuler"><i\nclass="material-icons">undo</i></button>',s.prepend(r),(0,a.qX)("Justificatif d'absence refusé !","success")},error:function(){(0,a.qX)("Une erreur est survenue !","danger")}})})),i(document).on("click",".justificatif-annuler",(function(t){var n=i(this).data("justificatif");i.ajax({url:Routing.generate("administration_absence_justificatif_change_etat",{uuid:n,etat:"D"}),success:function(t){var e=i(".bx_"+n),s=e.parent();e.remove();var r='<a href="#"\n                               class="btn btn-success btn-outline btn-square justificatif-accepte bx_'+n+'" data-provide="tooltip"\n                               data-justificatif="'+n+'"\n                               data-placement="bottom" title="atitle.accepter.le.justificatif"><i\n                                        class="ti-check"></i></a>\n                            <a href="#"\n                               class="btn btn-warning btn-outline btn-square justificatif-refuse bx_'+n+'" data-provide="tooltip"\n                               data-justificatif="'+n+'"\n                               data-placement="bottom" title="atitle.refuser.le.justificatif"><i\n                                        class="ti-na"></i></a>\n\n                            <a href="'+Routing.generate("administration_absence_justificatif_delete",{id:n})+'" data-csrf="{{ csrf_token(\'delete\' ~ justificatif.uuidString) }}"\n                               class="btn btn-danger btn-outline btn-square supprimer bx_'+n+'"><i\n                                        class="ti-close" data-provide="tooltip" data-placement="bottom"\n                                        title="atitle.supprimer"></i></a>';s.prepend(r),(0,a.qX)("Etat du justificatif d'absence annulé !","success")},error:function(t){(0,a.qX)("Une erreur est survenue !","danger")}})}))},1128:(t,n,e)=>{"use strict";e.d(n,{qX:()=>f,xQ:()=>h,XQ:()=>y,zl:()=>g,FX:()=>k});e(3843),e(83710),e(9653),e(74916),e(15306),e(23123),e(73210);var a,i,s,r=e(19755),c=e.n(r),o=e(86455),u=e.n(o),l=e(19755),d=!1;function f(t,n){console.log("callout");var e=new Array;e.success="Succès",e.danger="Erreur",e.warning="Attention";var a='<div class="callout callout-'+n+'" role="alert">\n                    <button type="button" class="close" data-dismiss="callout" aria-label="Close">\n                        <span>&times;</span>\n                    </button>\n                    <h5>'+e[n]+"</h5>\n                    <p>"+t+"</p>\n                </div>";c()("#mainContent").prepend(a).slideDown("slow"),c()(".callout").delay(5e3).slideUp("slow")}a=c()(location).attr("pathname"),i=a.split("/"),s=2,"index.php"===i[1]&&i.length>1&&(s=3),"super-administration"===i[s]&&(s+=1),""===i[i.length-1]&&i.pop(),c()(".menu-item").removeClass("active"),c()("#menu-"+i[s]).addClass("active"),u().mixin({customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1}),c()(document).on("click",".supprimer",(function(t){t.preventDefault();var n=c()(this).attr("href"),e=c()(this).data("csrf");u().fire({title:"Confirmer la suppression ?",text:"L'opération ne pourra pas être annulée.",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Oui, je confirme",cancelButtonText:"Non, Annuler",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1}).then((function(t){t.value?c().ajax({url:n,type:"DELETE",data:{_token:e},success:function(t){t.hasOwnProperty("redirect")&&t.hasOwnProperty("url")?document.location.href=t.url:(c()("#ligne_"+t).closest("tr").remove(),f("Suppression effectuée avec succès","success"),u().fire({title:"Supprimé!",text:"L'enregistrement a été supprimé.",icon:"success",confirmButtonText:"OK",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1}))},error:function(t,n,e){u().fire({title:"Erreur lors de la suppression!",text:"Merci de renouveler l'opération",icon:"error",confirmButtonText:"OK",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1}),f("Erreur lors de la tentative de suppression","danger")}}):"cancel"===t.dismiss&&u().fire({title:"Cancelled",text:"OK! Tout est comme avant !",icon:"error",confirmButtonText:"OK",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1})}))}));var p="",m="text",b=!1;function v(t){var n=c()("#myedit-input-"+t).val();c().ajax({url:p.attr("href"),data:{field:p.data("field"),value:n,type:m},method:"POST",success:function(){p.html(n),c()("#myEdit-zone-"+t).replaceWith(p),b=!1}})}function h(t,n){var e={};return c().each(c()(t).data(),(function(t,a){if("provide"!=(t=t.replace(/-([a-z])/g,(function(t){return t[1].toUpperCase()})))){if(null!=n)switch(n[t]){case"bool":a=Boolean(a);break;case"num":a=Number(a);break;case"array":a=a.split(",")}e[t]=a}})),e}function y(t){t.removeClass("is-valid").addClass("is-invalid")}function g(t){t.removeClass("is-invalid").addClass("is-valid")}function k(t){t.removeClass("is-invalid").removeClass("is-valid")}c()(document).on("click",".myedit",(function(t){t.preventDefault(),p=c()(this);var n,e,a="";b=!0,void 0!==c()(this).data("type")&&(m=c()(this).data("type")),"select"===c()(this).data("type")||("textarea"===c()(this).data("type")?(n=c()(this),e=Date.now(),d=!0,a='<div id="myEdit-zone-'+e+'">\n                      <textarea rows="5" class="form-control" id="myedit-input-'+e+'">'+n.html().trim()+'</textarea>\n                      <span class="input-group-append">\n <button class="btn btn-success-outline myedit-valide" data-key="'+e+'"><i class="fas fa-check"></i></button>\n                        <button class="btn btn-danger-outline myedit-annule"  data-key="'+e+'"><i class="fas fa-times"></i></button>\n                      </span>\n                    </div>'):a=function(t){var n=Date.now();return'<div id="myEdit-zone-'+n+'" class="input-group">\n                      <input type="text" class="form-control" id="myedit-input-'+n+'" value="'+t.html().trim()+'" >\n                      <span class="input-group-append">\n <button class="btn btn-success-outline myedit-valide"  data-key="'+n+'"><i class="fas fa-check"></i></button>\n                        <button class="btn btn-danger-outline myedit-annule"  data-key="'+n+'"><i class="fas fa-times"></i></button>\n                      </span>\n                    </div>'}(c()(this))),c()(this).replaceWith(a),c()("#myedit-input").focus()})),c()(document).on("keyup","#myedit-input",(function(t){13===t.keyCode&&!1===d?v():27===t.keyCode&&c()("#myEdit-zone").replaceWith(p)})),c()(document).on("click",".myedit-valide",(function(t){d=!1,t.preventDefault(),v(c()(this).data("key"))})),c()(document).on("keypress",(function(t){!0===b&&!1===d&&13===t.which&&(t.preventDefault(),v(c()(this).data("key"))),!0===b&&!1===d&&27===t.which&&(t.preventDefault(),c()("#myEdit-zone-"+c()(this).data("key")).replaceWith(p))})),c()(document).on("click",".myedit-annule",(function(t){t.preventDefault(),c()("#myEdit-zone-"+c()(this).data("key")).replaceWith(p)})),l.fn.dataAttr=function(t,n){return c()(this)[0].getAttribute("data-"+t)||n},l.fn.hasDataAttr=function(t){return c()(this)[0].hasAttribute("data-"+t)}}},0,[[31778,3666,9755,2109,6208,9904]]]);