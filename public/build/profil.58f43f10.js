(self.webpackChunk=self.webpackChunk||[]).push([[4686],{65946:(t,e,n)=>{"use strict";var a=n(93320),i=(n(66992),n(83710),n(41539),n(88674),n(39714),n(78783),n(33948),n(60285),function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"GET",a={method:n};return"GET"===n?t+="?"+new URLSearchParams(e).toString():a.body=JSON.stringify(e),fetch(t,a).then((function(t){return t.json()}))}),o=n(19755);o(document).on("change","#chgt_etudiant_departement",(function(){o.ajax({url:Routing.generate("user_change_departement",{etudiant:o(this).data("etudiant"),departement:o(this).val()}),method:"POST",success:function(t){o("#liste_groupes").empty().append('<tr><td colspan="3">Aucun groupe</td></tr>'),(0,a.qX)("Mofification enregistrée !","success")},error:function(t){(0,a.qX)("Erreur lors de la sauvegarde de la modification !","danger")}})})),o(document).on("change","#chgt_etudiant_fin",(function(){o.ajax({url:Routing.generate("user_change_annee_sortie",{etudiant:o(this).data("etudiant"),annee:o(this).val()}),method:"POST",success:function(t){(0,a.qX)("Mofification enregistrée !","success")},error:function(t){(0,a.qX)("Erreur lors de la sauvegarde de la modification !","danger")}})})),o(document).on("click",".changeprofil",(function(t){t.preventDefault(),t.stopPropagation();var e=o(this);o(".changeprofil").removeClass("active show"),o(this).addClass("active show"),o("#profilContent").empty().load(o(this).attr("href"),(function(){if("profil-about"===e.attr("id")){var t=document.querySelector("#valideCommentaire");t.addEventListener("click",(function(e){var n,o;e.preventDefault(),e.stopPropagation(),(n=Routing.generate("profil_etudiant_ajout_commentaire",{slug:t.getAttribute("data-slug")}),o={commentaire:document.querySelector("#texteCommentaire").value},i(n,o,"POST")).then((function(t){var e=document.createElement("p");e.textContent=t.commentaire,document.querySelector("#listeCommentaire").appendChild(e),(0,a.qX)("Commentaire ajouté avec succès.","success"),document.querySelector("#texteCommentaire").value=""})).catch((function(t){(0,a.qX)("Erreur lors de l'ajout du commentaire.","error")}))}))}e.attr("id")}))})),o(document).on("change",".addfavori",(function(t){t.preventDefault(),t.stopPropagation(),o.ajax({url:Routing.generate("user_add_favori"),method:"POST",data:{user:o(this).val(),etat:o(this).prop("checked")}})})),o(document).on("click","#btnabs",(function(t){o.ajax({url:Routing.generate("administration_absences_ajax_add"),data:{etudiant:o(this).data("etudiant"),date:o("#jourabs").val(),matiere:o("#moduleabs").val(),heure:o("#heureabs").val(),justif:o("input[type=radio][name=justifabs]:checked").val()},method:"POST",success:function(t){var e="",n="",a="";!0===t.justifie?(e="bg-pale-success",n="Oui",a="checked"):(e="bg-pale-warning",n="Non",a="");var i='<tr class="'+e+'" id="ligne_'+t.id+'">\n                    <td>'+t.date+" à "+t.heure+"</td>\n                    <td>"+t.codeMatiere+"</td>\n                    <td>"+n+'</td>\n                    <td class="hide">'+t.personnel+'</td>\n                    <td>\n                        <button data-provide="modaler tooltip"\n                                data-url="'+Routing.generate("app_etudiant_absence_detail",{uuid:t.uuidString})+'"\n                                class="btn btn-info btn-outline btn-square btn-xs"\n                                data-placement="bottom"\n                                title="Détails"\n                                data-title="Détails de l\'absence"\n                        >\n                            <i class="fas fa-info"></i>\n                        </button>\n                    </td>\n                        <td>\n                            <div class="custom-control custom-control-lg custom-checkbox">\n                                <input type="checkbox" class="custom-control-input checkAbsence" id="check_'+t.id+'"\n                                       data-absence="'+t.id+'" '+a+'>\n                                <label class="custom-control-label" for="check_'+t.id+'">Justifiée*</label>\n                            </div>\n                        </td>\n                </tr>';console.log(i),o("#tableAbsence > tbody:last").append(i)}})})),o(document).on("click",".checkAbsence",(function(t){var e=o(this).data("absence"),n=0;o(this).is(":checked")&&(n=1),o.ajax({url:Routing.generate("administration_absences_justifie",{absence:e,etat:n}),type:"GET",success:function(t){t?o("#ligne_"+e).removeClass("bg-pale-warning").addClass("bg-pale-success"):o("#ligne_"+e).removeClass("bg-pale-success").addClass("bg-pale-warning")}})})),o(document).on("click","#btnInit",(function(){console.log("init"),o.ajax({url:Routing.generate("security_password_init",{user:o(this).data("personnel")}),method:"POST",success:function(t){(0,a.qX)("Mot de passe initialisé !","success")},error:function(t){(0,a.qX)("Erreur lors l'initialisation du mot de passe !","danger")}})})),o(document).on("change","#chgt_etudiant_semestre",(function(){o.ajax({url:Routing.generate("user_change_semestre",{etudiant:o(this).data("etudiant"),semestre:o(this).val()}),method:"POST",success:function(t){o("#liste_groupes").empty().append('<tr><td colspan="3">Aucun groupe</td></tr>'),(0,a.qX)("Mofification enregistrée !","success")},error:function(t){(0,a.qX)("Erreur lors de la sauvegarde de la modification !","danger")}})}))},93320:(t,e,n)=>{"use strict";n.d(e,{qX:()=>m,xQ:()=>g,XQ:()=>v,zl:()=>y,FX:()=>k});n(3843),n(83710),n(9653),n(74916),n(15306),n(23123),n(73210);var a,i,o,s=n(19755),r=n.n(s),c=n(86455),u=n.n(c),l=n(19755),d=!1;function m(t,e){console.log("callout");var n=new Array;n.success="Succès",n.danger="Erreur",n.warning="Attention";var a='<div class="callout callout-'+e+'" role="alert">\n                    <button type="button" class="close" data-dismiss="callout" aria-label="Close">\n                        <span>&times;</span>\n                    </button>\n                    <h5>'+n[e]+"</h5>\n                    <p>"+t+"</p>\n                </div>";r()("#mainContent").prepend(a).slideDown("slow"),r()(".callout").delay(5e3).slideUp("slow")}a=r()(location).attr("pathname"),i=a.split("/"),o=2,"index.php"===i[1]&&i.length>1&&(o=3),"super-administration"===i[o]&&(o+=1),""===i[i.length-1]&&i.pop(),r()(".menu-item").removeClass("active"),r()("#menu-"+i[o]).addClass("active"),u().mixin({customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1}),r()(document).on("click",".supprimer",(function(t){t.preventDefault();var e=r()(this).attr("href"),n=r()(this).data("csrf");u().fire({title:"Confirmer la suppression ?",text:"L'opération ne pourra pas être annulée.",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Oui, je confirme",cancelButtonText:"Non, Annuler",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1}).then((function(t){t.value?r().ajax({url:e,type:"DELETE",data:{_token:n},success:function(t){t.hasOwnProperty("redirect")&&t.hasOwnProperty("url")?document.location.href=t.url:(r()("#ligne_"+t).closest("tr").remove(),m("Suppression effectuée avec succès","success"),u().fire({title:"Supprimé!",text:"L'enregistrement a été supprimé.",icon:"success",confirmButtonText:"OK",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1}))},error:function(t,e,n){u().fire({title:"Erreur lors de la suppression!",text:"Merci de renouveler l'opération",icon:"error",confirmButtonText:"OK",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1}),m("Erreur lors de la tentative de suppression","danger")}}):"cancel"===t.dismiss&&u().fire({title:"Cancelled",text:"OK! Tout est comme avant !",icon:"error",confirmButtonText:"OK",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1})}))}));var p="",f="text",h=!1;function b(t){var e=r()("#myedit-input-"+t).val();r().ajax({url:p.attr("href"),data:{field:p.data("field"),value:e,type:f},method:"POST",success:function(){p.html(e),r()("#myEdit-zone-"+t).replaceWith(p),h=!1}})}function g(t,e){var n={};return r().each(r()(t).data(),(function(t,a){if("provide"!=(t=t.replace(/-([a-z])/g,(function(t){return t[1].toUpperCase()})))){if(null!=e)switch(e[t]){case"bool":a=Boolean(a);break;case"num":a=Number(a);break;case"array":a=a.split(",")}n[t]=a}})),n}function v(t){t.removeClass("is-valid").addClass("is-invalid")}function y(t){t.removeClass("is-invalid").addClass("is-valid")}function k(t){t.removeClass("is-invalid").removeClass("is-valid")}r()(document).on("click",".myedit",(function(t){t.preventDefault(),p=r()(this);var e,n,a="";h=!0,void 0!==r()(this).data("type")&&(f=r()(this).data("type")),"select"===r()(this).data("type")||("textarea"===r()(this).data("type")?(e=r()(this),n=Date.now(),d=!0,a='<div id="myEdit-zone-'+n+'">\n                      <textarea rows="5" class="form-control" id="myedit-input-'+n+'">'+e.html().trim()+'</textarea>\n                      <span class="input-group-append">\n <button class="btn btn-success-outline myedit-valide" data-key="'+n+'"><i class="fas fa-check"></i></button>\n                        <button class="btn btn-danger-outline myedit-annule"  data-key="'+n+'"><i class="fas fa-times"></i></button>\n                      </span>\n                    </div>'):a=function(t){var e=Date.now();return'<div id="myEdit-zone-'+e+'" class="input-group">\n                      <input type="text" class="form-control" id="myedit-input-'+e+'" value="'+t.html().trim()+'" >\n                      <span class="input-group-append">\n <button class="btn btn-success-outline myedit-valide"  data-key="'+e+'"><i class="fas fa-check"></i></button>\n                        <button class="btn btn-danger-outline myedit-annule"  data-key="'+e+'"><i class="fas fa-times"></i></button>\n                      </span>\n                    </div>'}(r()(this))),r()(this).replaceWith(a),r()("#myedit-input").focus()})),r()(document).on("keyup","#myedit-input",(function(t){13===t.keyCode&&!1===d?b():27===t.keyCode&&r()("#myEdit-zone").replaceWith(p)})),r()(document).on("click",".myedit-valide",(function(t){d=!1,t.preventDefault(),b(r()(this).data("key"))})),r()(document).on("keypress",(function(t){!0===h&&!1===d&&13===t.which&&(t.preventDefault(),b(r()(this).data("key"))),!0===h&&!1===d&&27===t.which&&(t.preventDefault(),r()("#myEdit-zone-"+r()(this).data("key")).replaceWith(p))})),r()(document).on("click",".myedit-annule",(function(t){t.preventDefault(),r()("#myEdit-zone-"+r()(this).data("key")).replaceWith(p)})),l.fn.dataAttr=function(t,e){return r()(this)[0].getAttribute("data-"+t)||e},l.fn.hasDataAttr=function(t){return r()(this)[0].hasAttribute("data-"+t)}}},0,[[65946,3666,9755,2109,6208,9904,5322]]]);