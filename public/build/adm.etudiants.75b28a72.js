(self.webpackChunkintranetv3=self.webpackChunkintranetv3||[]).push([[9667],{291:(t,a,e)=>{var n=e(9755);n(document).on("change",".changeEtat",(function(){n.ajax({url:Routing.generate("adm_etudiant_change_etat",{uuid:n(this).data("etudiant"),etat:n(this).val()}),method:"POST",success:function(){}})})),n(document).on("change",".editEtudiant",(function(){n.ajax({url:Routing.generate("adm_etudiant_edit_ajax",{id:n(this).data("etudiant")}),method:"POST",data:{field:n(this).data("field"),value:n(this).val()},success:function(){}})}))}},t=>{"use strict";t.O(0,[9755],(()=>{return a=291,t(t.s=a);var a}));t.O()}]);