//開くボタンを押した時には
$(".open-btn").click(function () {
  $("#search-wrap").addClass('panelactive');//#search-wrapへpanelactiveクラスを付与
$('#search-text').focus();//テキスト入力のinputにフォーカス
});

//閉じるボタンを押した時には
$(".close-btn").click(function () {
  $("#search-wrap").removeClass('panelactive');//#search-wrapからpanelactiveクラスを除去
});

document.addEventListener('click',e=>{
      const t=e.target;
      if(t.closest('.user_profile_img_wrap')){
        profile_menu_wrap.classList.toggle('display');
      }else if(!t.closest('.display')){
        profile_menu_wrap.classList.remove('display');
      }
});

document.addEventListener('click',e=>{
  const t=e.target;
  if(t.closest('.report_wrap')){
    report_menu_wrap.classList.toggle('display2');
  }else if(!t.closest('.display2')){
    report_menu_wrap.classList.remove('display2');
  }
});
