function offSide(){
    $(".fa-bars").attr("onclick","onSide()");
    document.querySelector(".head").style.marginLeft="-3px";
    document.querySelector(".head").style.transition="0.5s";
    document.querySelector(".in-content").style.paddingLeft="26px";
    document.querySelector(".in-content").style.transition="0.5s";
    document.querySelector(".sidebar").style.marginLeft="-200px";
    document.querySelector(".sidebar").style.transition="0.5s";

    const nodeList = document.querySelectorAll(".box");
    for (let i = 0; i < nodeList.length; i++) {
        nodeList[i].style.width="280px";
        nodeList[i].style.transition="0.5s";
    }
}
function onSide(){
    $(".fa-bars").attr("onclick","offSide()");

    document.querySelector(".head").style.marginLeft="200px";
    document.querySelector(".head").style.transition="0.5s";
    document.querySelector(".in-content").style.paddingLeft="211px";
    document.querySelector(".in-content").style.transition="0.5s";
    document.querySelector(".sidebar").style.marginLeft="0px";
    document.querySelector(".sidebar").style.transition="0.5s";

    const nodeList = document.querySelectorAll(".box");
    for (let i = 0; i < nodeList.length; i++) {
        nodeList[i].style.width="240px";
        nodeList[i].style.transition="0.5s";
    }
}