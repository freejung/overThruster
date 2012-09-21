Ext.onReady(function() {
    MODx.load({ xtype: 'overthruster-page-home'});
});

overThruster.page.Home = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        components: [{
            xtype: 'overthruster-panel-home'
            ,renderTo: 'overthruster-panel-home-div'
        }]
    }); 
    overThruster.page.Home.superclass.constructor.call(this,config);
};
Ext.extend(overThruster.page.Home,MODx.Component);
Ext.reg('overthruster-page-home',overThruster.page.Home);