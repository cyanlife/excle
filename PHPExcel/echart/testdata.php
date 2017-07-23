
<script>
function getusers() {
    $.ajax({
        type: "post",
        async: false,
        url: "data.php",
        data: {},
        dataType: "json",
        success: function(result){
            if(result){
                for(var i = 0 ; i < result.length; i++){

                    ages.push(result[i].age);
                    names.push(result[i].name);
                    //names.push(result[i].name);
                    //ages.push(result[i].age);//饼状图需

                     
                    alls.push('value:'+result[i].age+',name:'+result[i].name);
                }
            }
        },
        error: function(errmsg) {
            alert("Ajax获取服务器数据出错了！"+ errmsg);
        }
    });
    return alls;

}
getusers();
</script>
<?php
 echo alls;
?>