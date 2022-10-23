$(document).ready(function (){
   window.metricsCollectorTest = function (username = 'Ivan') {
       require(['core/ajax'], function(ajax) {
           var promises = ajax.call([
               { methodname: 'local_test_hello_world', args: {username: username}}
           ]);

           promises[0].then(function(response) {
               console.log(response);
           }).fail(function(ex) {
               console.log(ex);
           });
       });
   }
});