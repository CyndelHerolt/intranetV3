(self.webpackChunkintranetv3=self.webpackChunkintranetv3||[]).push([[6571],{7690:(t,e,n)=>{"use strict";n(4916),n(3123),n(4678),n(6977),n(1058);var a=n(2396),r=n(9755),i=n(9755),o=1;function s(){for(var t=0,e=0,n=0,a=0,i=0,s=0,l=0,c=0,u=1;u<=o;u++){var d=r("#cm_"+u),p=r("#td_"+u),m=r("#tp_"+u);t+=parseFloat(d.val())*parseInt(r("#gr_cm_"+u).val()),e+=parseFloat(p.val())*parseInt(r("#gr_td_"+u).val()),n+=parseFloat(m.val())*parseInt(r("#gr_tp_"+u).val()),s+=parseFloat(d.val()),l+=parseFloat(p.val()),c+=parseFloat(m.val()),i=i+parseFloat(d.val())+parseFloat(p.val())+parseFloat(m.val())}a=t+e+n,r("#totalCm").html(t.toFixed(2)),r("#totalTd").html(e.toFixed(2)),r("#totalTp").html(n.toFixed(2)),r("#totalEqTd").html(a.toFixed(2)),r("#totalEtu").html(i.toFixed(2)),r("#totalHeuresCm").html(s.toFixed(2)),r("#totalHeuresTd").html(l.toFixed(2)),r("#totalHeuresTp").html(c.toFixed(2));var v=parseFloat(r("#cmMaquette").html())-s,f=parseFloat(r("#tdMaquette").html())-l,h=parseFloat(r("#tpMaquette").html())-c;r("#diffCm").html(v.toFixed(2)),r("#diffTd").html(f.toFixed(2)),r("#diffTp").html(h.toFixed(2)),v<0?r("#diffCm").addClass("erreurPrevi").removeClass("validePrevi"):r("#diffCm").addClass("validePrevi").removeClass("erreurPrevi"),f<0?r("#diffTd").addClass("erreurPrevi").removeClass("validePrevi"):r("#diffTd").addClass("validePrevi").removeClass("erreurPrevi"),h<0?r("#diffTp").addClass("erreurPrevi").removeClass("validePrevi"):r("#diffTp").addClass("validePrevi").removeClass("erreurPrevi")}r(document).on("change",".changeIntervenantPrevi",(function(t){t.preventDefault(),t.stopPropagation(),r.ajax({url:Routing.generate("administration_previsionnel_ajax_edit",{id:r(this).data("previ")}),method:"POST",data:{value:r(this).val(),field:"personnel"},success:function(){(0,a.qX)("Modification de prévisionnel enregistrée !","success")},error:function(){(0,a.qX)("Erreur lors de la modification du prévisionnel !","danger")}})})),r(document).on("change","#previSemestre",(function(t){t.preventDefault(),t.stopPropagation(),r("#blocPrevisionnel").empty().load(Routing.generate("administration_previsionnel_semestre",{semestre:r(this).val(),annee:r(this).data("annee")}))})),r(document).on("click","#reloadPreviSemestre",(function(t){t.preventDefault(),t.stopPropagation(),r("#blocPrevisionnel").empty().load(Routing.generate("administration_previsionnel_semestre",{semestre:r(this).data("semestre"),annee:r(this).data("annee")}))})),r(document).on("change","#previMatiere",(function(t){var e=r(this).val().split("_");t.preventDefault(),t.stopPropagation(),r("#blocPrevisionnel").empty().load(Routing.generate("administration_previsionnel_matiere",{matiere:e[1],type:e[0],annee:r(this).data("annee")}))})),r(document).on("click","#reloadPreviMatiere",(function(t){t.preventDefault(),t.stopPropagation(),r("#blocPrevisionnel").empty().load(Routing.generate("administration_previsionnel_matiere",{matiere:r(this).data("matiere"),type:r(this).data("type"),annee:r(this).data("annee")}))})),r(document).on("change","#previPersonnel",(function(t){t.preventDefault(),t.stopPropagation(),r("#blocPrevisionnel").empty().load(Routing.generate("administration_previsionnel_personnel",{personnel:r(this).val(),annee:r(this).data("annee")}))})),r(document).on("click","#reloadPreviPersonnel",(function(t){t.preventDefault(),t.stopPropagation(),r("#blocPrevisionnel").empty().load(Routing.generate("administration_previsionnel_personnel",{personnel:r(this).data("personnel"),annee:r(this).data("annee")}))})),r(document).on("click",".previsionnel_add_change",(function(t){t.preventDefault(),t.stopPropagation(),r(".previsionnel_add_change").removeClass("active show"),r(this).addClass("active show"),r("#mainContent").empty().load(r(this).attr("href"))})),r(document).on("click","#addIntervenantPrevisionnel",(function(t){t.preventDefault(),t.stopPropagation(),o++,r.ajax({url:Routing.generate("api_enseignants_departement"),method:"POST",success:function(t){var e='<tr>\n                        <td>\n                            <select class="form-control" data-live-search="true" name="intervenant_'+o+'" id="intervenant_'+o+'">\n                                <option value="">Choisir l\'intervenant</option>\n';i.each(t,(function(t,n){e=e+'<option value="'+n.id+'">'+n.display+"</option>\n"})),e=e+'                            </select>\n                        </td>\n                        <td><input type="text" name="cm_'+o+'" id="cm_'+o+'" data-ligne="'+o+'" class="form-control chgcm" value="0"></td>\n                        <td><input type="number" name="gr_cm_'+o+'" id="gr_cm_'+o+'" value="0" data-ligne="'+o+'" class="form-control chgcm">\n                        </td>\n                        <td id="ind_cm_'+o+'">0</td>\n                        <td style="background-color: #68C39F"><input type="text" value="0" name="td_'+o+'" id="td_'+o+'" data-ligne="'+o+'"\n                                                                     class="form-control chgtd"></td>\n                        <td style="background-color: #68C39F"><input type="number" value="0" name="gr_td_'+o+'" id="gr_td_'+o+'"\n                                                                     data-ligne="'+o+'" class="form-control chgtd"></td>\n                        <td style="background-color: #68C39F" id="ind_td_'+o+'">0</td>\n                        <td style="background-color: #FFC052"><input type="text" value="0" name="tp_'+o+'" id="tp_'+o+'" data-ligne="'+o+'"\n                                                                     class="form-control chgtp"></td>\n                        <td style="background-color: #FFC052"><input type="number" value="0" name="gr_tp_'+o+'" id="gr_tp_'+o+'"\n                                                                     data-ligne="'+o+'" class="form-control chgtp"></td>\n                        <td style="background-color: #FFC052" id="ind_tp_'+o+'">0</td>\n                    </tr>',r("#nbLigne").val(o),r("#ligneAdd").before(e)}})})),r(document).on("change",".chgcm",(function(t){var e=r(this).data("ligne"),n=parseFloat(r("#cm_"+e).val())/1.5;r("#ind_cm_"+e).html(n.toFixed(2)),s()})),r(document).on("change",".chgtd",(function(t){var e=r(this).data("ligne"),n=parseFloat(r("#td_"+e).val())/1.5;r("#ind_td_"+e).html(n.toFixed(2)),s()})),r(document).on("change",".chgtp",(function(t){var e=r(this).data("ligne"),n=parseFloat(r("#tp_"+e).val())/1.5;r("#ind_tp_"+e).html(n.toFixed(2)),s()})),r(document).on("change","#previsionnel_matiere",(function(){var t=r("#volumeMatiere");""===r(this).val()?t.html("Choisir d'abord une matière"):r.ajax({url:Routing.generate("api_matiere",{matiere:r(this).val()}),success:function(e){var n="PPN Officiel => CM "+e.cmFormation+" heure(s); TD "+e.tdFormation+" heure(s); TP "+e.tpFormation+" heure(s); PPN Réalisé/departement => CM "+e.cmPpn+" heure(s); TD "+e.tdPpn+" heure(s); TP "+e.tpPpn+" heure(s);";t.html(n),r("#cmMaquette").html(e.cmFormation),r("#totalHeuresCm").html(0),r("#diffCm").html(0),r("#tdMaquette").html(e.tdFormation),r("#totalHeuresTd").html(0),r("#diffTd").html(0),r("#tpMaquette").html(e.tpFormation),r("#totalHeuresTp").html(0),r("#diffTp").html(0),r("#tabheures").show()}})})),r(document).on("click","#btnGenereFichier",(function(t){t.preventDefault(),t.stopPropagation();var e=[];r("input:checkbox[name=exportChamps]:checked").each((function(){e.push(r(this).val())})),r.ajax({url:Routing.generate("export_listing.fr"),method:"POST",data:{matiere:r(this).data("matiere"),exportTypeDocument:r("input[type=radio][name=exportTypeDocument]:checked").val(),exportChamps:e,exportFormat:r("input[type=radio][name=exportFormat]:checked").val(),exportFiltre:r("input[type=radio][name=exportFiltre]:checked").val()},success:function(t){}})})),r(document).on("change","#change_annee_temp_hrs",(function(t){window.location=Routing.generate("administration_hrs_index",{annee:r(this).val()})})),r(document).on("change","#change_annee_temp_previsionnel",(function(t){window.location=Routing.generate("administration_previsionnel_index",{annee:r(this).val()})}))},2396:(t,e,n)=>{"use strict";n.d(e,{qX:()=>b,FX:()=>O,xQ:()=>P,bV:()=>y,XQ:()=>k,zl:()=>w});n(4916),n(3123),n(3843),n(3710),n(3210),n(5306),n(9653);var a=n(6455),r=n.n(a),i=(n(9070),n(7941),n(2526),n(7327),n(5003),n(9554),n(4747),n(9337),n(3321),n(8588)),o=n.n(i);function s(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(t);e&&(a=a.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,a)}return n}function l(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?s(Object(n),!0).forEach((function(e){u(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):s(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}function c(t,e){for(var n=0;n<e.length;n++){var a=e[n];a.enumerable=a.enumerable||!1,a.configurable=!0,"value"in a&&(a.writable=!0),Object.defineProperty(t,a.key,a)}}function u(t,e,n){return e in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}const d=new(function(){function t(){!function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,t),u(this,"defaultOptions",{close:!0,duration:3e3,className:"toast",escapeMarkup:!1,gravity:"top",position:"right",stopOnFocus:!0})}var e,n,a;return e=t,(n=[{key:"show",value:function(t,e){var n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:null,a=arguments.length>3&&void 0!==arguments[3]?arguments[3]:{};(a=l(l({},this.defaultOptions),a)).className+=" toast-"+t;var r='<div class="toast-wrapper">';n&&(r+='<div class="toast-head">'+n+"</div>"),r+='<div class="toast-body">'+e+"</div>",r+="</div>",a.text=r,o()(a).showToast()}},{key:"error",value:function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:null,n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:{};this.show("error",t,e,n)}},{key:"warning",value:function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:null,n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:{};this.show("warning",t,e,n)}},{key:"success",value:function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:null,n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:{};this.show("success",t,e,n)}},{key:"info",value:function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:null,n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:{};this.show("info",t,e,n)}}])&&c(e.prototype,n),a&&c(e,a),t}());var p,m,v,f=n(9755),h=n(9755),g=!1;function y(t,e){for(e=e.toLowerCase();t&&t.nodeName.toLowerCase()!=e;)t=t.parentNode;return t||null}function b(t,e){switch(e){case"success":d.success(t);break;case"danger":d.error(t);break;case"warning":d.warning(t);break;case"info":d.info(t)}}p=f(location).attr("pathname"),m=p.split("/"),v=2,"index.php"===m[1]&&m.length>1&&(v=3),"super-administration"===m[v]&&(v+=1),""===m[m.length-1]&&m.pop(),f(".menu-item").removeClass("active"),f("#menu-"+m[v]).addClass("active"),r().mixin({customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1}),f(document).on("click",".supprimer",(function(t){t.preventDefault();var e=f(this).attr("href"),n=f(this).data("csrf");r().fire({title:"Confirmer la suppression ?",text:"L'opération ne pourra pas être annulée.",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Oui, je confirme",cancelButtonText:"Non, Annuler",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1}).then((function(a){a.value?f.ajax({url:e,type:"DELETE",data:{_token:n},success:function(e){if(e.hasOwnProperty("redirect")&&e.hasOwnProperty("url"))document.location.href=e.url;else{var n=y(t.target,"tr");n.parentNode.removeChild(n),b("Suppression effectuée avec succès","success"),r().fire({title:"Supprimé!",text:"L'enregistrement a été supprimé.",icon:"success",confirmButtonText:"OK",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1})}},error:function(t,e,n){r().fire({title:"Erreur lors de la suppression!",text:"Merci de renouveler l'opération",icon:"error",confirmButtonText:"OK",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1}),b("Erreur lors de la tentative de suppression","danger")}}):"cancel"===a.dismiss&&r().fire({title:"Cancelled",text:"OK! Tout est comme avant !",icon:"error",confirmButtonText:"OK",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1})}))}));var _="",x="text",C=!1;function F(t){var e=f("#myedit-input-"+t).val();f.ajax({url:_.attr("href"),data:{field:_.data("field"),value:e,type:x},method:"POST",success:function(){_.html(e),f("#myEdit-zone-"+t).replaceWith(_),C=!1}})}function P(t,e){var n={};return f.each(f(t).data(),(function(t,a){if("provide"!=(t=t.replace(/-([a-z])/g,(function(t){return t[1].toUpperCase()})))){if(null!=e)switch(e[t]){case"bool":a=Boolean(a);break;case"num":a=Number(a);break;case"array":a=a.split(",")}n[t]=a}})),n}function k(t){t.removeClass("is-valid").addClass("is-invalid")}function w(t){t.removeClass("is-invalid").addClass("is-valid")}function O(t){t.removeClass("is-invalid").removeClass("is-valid")}f(document).on("click",".myedit",(function(t){t.preventDefault(),_=f(this);var e,n,a="";C=!0,void 0!==f(this).data("type")&&(x=f(this).data("type")),"select"===f(this).data("type")||("textarea"===f(this).data("type")?(e=f(this),n=Date.now(),g=!0,a='<div id="myEdit-zone-'+n+'">\n                      <textarea rows="5" class="form-control" id="myedit-input-'+n+'">'+e.html().trim()+'</textarea>\n                      <span class="input-group-append">\n <button class="btn btn-success-outline myedit-valide" data-key="'+n+'"><i class="fas fa-check"></i></button>\n                        <button class="btn btn-danger-outline myedit-annule"  data-key="'+n+'"><i class="fas fa-times"></i></button>\n                      </span>\n                    </div>'):a=function(t){var e=Date.now();return'<div id="myEdit-zone-'+e+'" class="input-group">\n                      <input type="text" class="form-control" id="myedit-input-'+e+'" value="'+t.html().trim()+'" >\n                      <span class="input-group-append">\n <button class="btn btn-success-outline myedit-valide"  data-key="'+e+'"><i class="fas fa-check"></i></button>\n                        <button class="btn btn-danger-outline myedit-annule"  data-key="'+e+'"><i class="fas fa-times"></i></button>\n                      </span>\n                    </div>'}(f(this))),f(this).replaceWith(a),f("#myedit-input").focus()})),f(document).on("keyup","#myedit-input",(function(t){13===t.keyCode&&!1===g?F():27===t.keyCode&&f("#myEdit-zone").replaceWith(_)})),f(document).on("click",".myedit-valide",(function(t){g=!1,t.preventDefault(),F(f(this).data("key"))})),f(document).on("keypress",(function(t){!0===C&&!1===g&&13===t.which&&(t.preventDefault(),F(f(this).data("key"))),!0===C&&!1===g&&27===t.which&&(t.preventDefault(),f("#myEdit-zone-"+f(this).data("key")).replaceWith(_))})),f(document).on("click",".myedit-annule",(function(t){t.preventDefault(),f("#myEdit-zone-"+f(this).data("key")).replaceWith(_)})),h.fn.dataAttr=function(t,e){return f(this)[0].getAttribute("data-"+t)||e},h.fn.hasDataAttr=function(t){return f(this)[0].hasAttribute("data-"+t)}},2814:(t,e,n)=>{var a=n(7854),r=n(3111).trim,i=n(1361),o=a.parseFloat,s=1/o(i+"-0")!=-1/0;t.exports=s?function(t){var e=r(String(t)),n=o(e);return 0===n&&"-"==e.charAt(0)?-0:n}:o},3009:(t,e,n)=>{var a=n(7854),r=n(3111).trim,i=n(1361),o=a.parseInt,s=/^[+-]?0[Xx]/,l=8!==o(i+"08")||22!==o(i+"0x16");t.exports=l?function(t,e){var n=r(String(t));return o(n,e>>>0||(s.test(n)?16:10))}:o},8415:(t,e,n)=>{"use strict";var a=n(9958),r=n(4488);t.exports="".repeat||function(t){var e=String(r(this)),n="",i=a(t);if(i<0||i==1/0)throw RangeError("Wrong number of repetitions");for(;i>0;(i>>>=1)&&(e+=e))1&i&&(n+=e);return n}},863:(t,e,n)=>{var a=n(4326);t.exports=function(t){if("number"!=typeof t&&"Number"!=a(t))throw TypeError("Incorrect invocation");return+t}},6977:(t,e,n)=>{"use strict";var a=n(2109),r=n(9958),i=n(863),o=n(8415),s=n(7293),l=1..toFixed,c=Math.floor,u=function(t,e,n){return 0===e?n:e%2==1?u(t,e-1,n*t):u(t*t,e/2,n)};a({target:"Number",proto:!0,forced:l&&("0.000"!==8e-5.toFixed(3)||"1"!==.9.toFixed(0)||"1.25"!==1.255.toFixed(2)||"1000000000000000128"!==(0xde0b6b3a7640080).toFixed(0))||!s((function(){l.call({})}))},{toFixed:function(t){var e,n,a,s,l=i(this),d=r(t),p=[0,0,0,0,0,0],m="",v="0",f=function(t,e){for(var n=-1,a=e;++n<6;)a+=t*p[n],p[n]=a%1e7,a=c(a/1e7)},h=function(t){for(var e=6,n=0;--e>=0;)n+=p[e],p[e]=c(n/t),n=n%t*1e7},g=function(){for(var t=6,e="";--t>=0;)if(""!==e||0===t||0!==p[t]){var n=String(p[t]);e=""===e?n:e+o.call("0",7-n.length)+n}return e};if(d<0||d>20)throw RangeError("Incorrect fraction digits");if(l!=l)return"NaN";if(l<=-1e21||l>=1e21)return String(l);if(l<0&&(m="-",l=-l),l>1e-21)if(n=(e=function(t){for(var e=0,n=t;n>=4096;)e+=12,n/=4096;for(;n>=2;)e+=1,n/=2;return e}(l*u(2,69,1))-69)<0?l*u(2,-e,1):l/u(2,e,1),n*=4503599627370496,(e=52-e)>0){for(f(0,n),a=d;a>=7;)f(1e7,0),a-=7;for(f(u(10,a,1),0),a=e-1;a>=23;)h(1<<23),a-=23;h(1<<a),f(1,1),h(2),v=g()}else f(0,n),f(1<<-e,0),v=g()+o.call("0",d);return v=d>0?m+((s=v.length)<=d?"0."+o.call("0",d-s)+v:v.slice(0,s-d)+"."+v.slice(s-d)):m+v}})},4678:(t,e,n)=>{var a=n(2109),r=n(2814);a({global:!0,forced:parseFloat!=r},{parseFloat:r})},1058:(t,e,n)=>{var a=n(2109),r=n(3009);a({global:!0,forced:parseInt!=r},{parseInt:r})}},t=>{"use strict";t.O(0,[9755,2109,4093,1870,8771],(()=>{return e=7690,t(t.s=e);var e}));t.O()}]);