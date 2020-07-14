// All of the Node.js APIs are available in the preload process.
// It has the same sandbox as a Chrome extension.
window.addEventListener('DOMContentLoaded', () => {
  const axios = require('axios').default;
  const request = require('request');
  const os = require ('os');
  const computerName = os.hostname();
  let userInfo = os.userInfo();
  console.log('ten may:' + computerName);

  const replaceText = (selector, text) => {
    const element = document.getElementById(selector)
    if (element) element.innerText = text
  }

  for (const type of ['chrome', 'node', 'electron']) {
    replaceText(`${type}-version`, process.versions[type])
  }

  $(document).ready(function() {
    $(document).on('click',"#sendForm", function(e){
        // let email = $("#email").val();
        // let password = $("#password").val();
        //e.preventdefault();

        //test
        // request("http://blog.com/home/searchmember", function(err, response, body) {
        //   let bodySon = JSON.parse(body);
        //   console.log(bodySon);
        //   debugger;
        // });

        var keyword = 'tran';
      alert(keyword);
        axios.post('http://blog.com/home/searchmember', keyword)
            .then(function (res) {
                console.log(res);
                debugger;
                //$("#result").append(res.data);
                
            })
            .catch(function (res) {
                console.log('response fail');
            });

        //alert($('meta[name="csrf-token"]').attr('content'));
        //debugger;
        // $.ajaxSetup({
        //     headers: {
        //         //'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         //'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr("content")
        //         'X-CSRF-TOKEN' : 'XVXqCS42b74qPllfQtKaay4J5s6lqga02H2Q0hID2'
        //     }
        // });
        // $.ajax({
        //     url: 'http://blog.com/home/searchmember',
        //     type: 'post',
        //     dataType: 'json',
        //     data: {
        //         keyword: keyword
        //     }

        // }).done(function(res) {
        //      console.log(res);
        //           debugger;
        //     // $("#result_member").empty();
        //     // $("#result_member").append(res.list_member);
        // })

    });
  });

  // function httpGet(theUrl) {
  //   var xmlHttp = new XMLHttpRequest();
  //   xmlHttp.open( "GET", theUrl, false ); // false for synchronous request
  //   xmlHttp.send( null );
  //   return xmlHttp.responseText;
  // }
})



