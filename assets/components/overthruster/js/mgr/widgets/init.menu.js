var topic = '/overthruster/';
var register = 'mgr';
var console = MODx.load({
   xtype: 'modx-console'
   ,register: register
   ,topic: topic
   ,show_filename: 0
   ,listeners: {
     'shutdown': {fn:function() {
         /* do code here when you close the console */
     },scope:this}
   }
});
console.show(Ext.getBody());

MODx.Ajax.request({
    url: MODx.config.overthruster_assets_url + 'connector.php'
    ,params: {
        action: 'mgr/init/fullinit'
        ,register: register
        ,topic: topic
    }
    ,listeners: {
        'success':{fn:function() {
            console.fireEvent('complete');
        },scope:this}
    }
});