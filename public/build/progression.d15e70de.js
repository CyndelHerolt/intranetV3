(self.webpackChunk=self.webpackChunk||[]).push([[1996],{88990:(t,e,a)=>{var _=a(19755);a(91058),_(document).on("change",".updateProgression",(function(){var t,e,a,r;t=_(this).data("semaine"),e=_(this).data("type"),a=_(this).data("matiere"),r=_(this).val(),_.ajax({url:Routing.generate("application_personnel_progression_update",{matiere:a}),data:{semaine:t,typecours:e,nbSeances:r},method:"POST"}),function(t,e,a){var r=parseInt(_("#nbgr_cm_"+a).text()),n=parseInt(_("#nbgr_td_"+a).text()),o=parseInt(_("#nbgr_tp_"+a).text()),s="tot_s"+t+"_"+a,p=parseInt(_("#"+s+"_cm").val());isNaN(p)&&(p=0);var i=parseInt(_("#"+s+"_td").val());isNaN(i)&&(i=0);var c=parseInt(_("#"+s+"_tp").val());isNaN(c)&&(c=0);var x=p*r*1.5+i*n*1.5+c*o*1.5;_("#"+s).text(x);var u="tot_cm_"+a,h="tot_td_"+a,l="tot_tp_"+a,v="tot_cm_seance_"+a,d="tot_td_seance_"+a,m="tot_tp_seance_"+a,f="tot_"+a,g="tot_seance_"+a,I="tot_cm_h_"+a,N="tot_td_h_"+a,b="tot_tp_h_"+a,k="tot_h_"+a,y=0,S=0,R=0;_(".cm_"+a).each((function(){var t=parseInt(_(this).val());isNaN(t)&&(t=0),y+=t})),_("#"+v).text(y),_("#"+u).text(y*r),_("#"+I).text(1.5*y*r),_(".td_"+a).each((function(){var t=parseInt(_(this).val());isNaN(t)&&(t=0),S+=t})),_("#"+d).text(S),_("#"+h).text(S*n),_("#"+N).text(1.5*S*n),_(".tp_"+a).each((function(){var t=parseInt(_(this).val());isNaN(t)&&(t=0),R+=t})),_("#"+m).text(R),_("#"+l).text(R*o),_("#"+b).text(1.5*R*o),_("#"+g).text(y+S+R),_("#"+f).text(y*r+S*n+R*o),_("#"+k).text(1.5*y*r+1.5*S*n+1.5*R*o)}(_(this).data("semaine"),_(this).data("type"),_(this).data("matiere"))})),_(document).on("click","#refresh",(function(){!function(){for(var t=Array(),e=1;e<15;e++)t[e]=0;t.total=0,t.total_groupe=0,t.total_heure=0,_(".une_matiere").each((function(){for(var e=_(this).data("matiere"),a=parseInt(_("#nbgr_cm_"+e).text()),r=parseInt(_("#nbgr_td_"+e).text()),n=parseInt(_("#nbgr_tp_"+e).text()),o=0,s=0,p=0,i=1;i<15;i++){var c="tot_s"+i+"_"+e,x=parseInt(_("#"+c+"_cm").val());isNaN(x)&&(x=0),o+=x;var u=parseInt(_("#"+c+"_td").val());isNaN(u)&&(u=0),s+=u;var h=parseInt(_("#"+c+"_tp").val());isNaN(h)&&(h=0),p+=h;var l=x*a*1.5+u*r*1.5+h*n*1.5;_("#"+c).text(l),t[i]+=l}var v="tot_cm_"+e,d="tot_td_"+e,m="tot_tp_"+e,f="tot_td_seance_"+e,g="tot_tp_seance_"+e,I="tot_"+e,N="tot_seance_"+e,b="tot_cm_h_"+e,k="tot_td_h_"+e,y="tot_tp_h_"+e,S="tot_h_"+e;_("#"+("tot_cm_seance_"+e)).text(o),_("#"+v).text(o*a),_("#"+b).text(1.5*o*a),_("#"+f).text(s),_("#"+d).text(s*r),_("#"+k).text(1.5*s*r),_("#"+g).text(p),_("#"+m).text(p*n),_("#"+y).text(1.5*p*n),_("#"+N).text(o+s+p),_("#"+I).text(o*a+s*r+p*n),_("#"+S).text(1.5*o*a+1.5*s*r+1.5*p*n),t.total+=o+s+p,t.total_groupe+=o*a+s*r+p*n,t.total_heure+=1.5*o*a+1.5*s*r+1.5*p*n}));for(e=1;e<15;e++)_("#tot_s"+e).text(t[e]);_("#tot_seance").text(t.total),_("#tot_global_groupe").text(t.total_groupe),_("#tot_global_heure").text(t.total_heure)}()}))},83009:(t,e,a)=>{var _=a(17854),r=a(53111).trim,n=a(81361),o=_.parseInt,s=/^[+-]?0[Xx]/,p=8!==o(n+"08")||22!==o(n+"0x16");t.exports=p?function(t,e){var a=r(String(t));return o(a,e>>>0||(s.test(a)?16:10))}:o},53111:(t,e,a)=>{var _=a(84488),r="["+a(81361)+"]",n=RegExp("^"+r+r+"*"),o=RegExp(r+r+"*$"),s=function(t){return function(e){var a=String(_(e));return 1&t&&(a=a.replace(n,"")),2&t&&(a=a.replace(o,"")),a}};t.exports={start:s(1),end:s(2),trim:s(3)}},81361:t=>{t.exports="\t\n\v\f\r                　\u2028\u2029\ufeff"},91058:(t,e,a)=>{var _=a(82109),r=a(83009);_({global:!0,forced:parseInt!=r},{parseInt:r})}},0,[[88990,3666,9755,2109]]]);