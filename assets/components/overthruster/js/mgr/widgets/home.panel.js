overThruster.panel.Home = function(config) {
    config = config || {};
    Ext.apply(config,{
        border: false
        ,baseCls: 'modx-formpanel'
        ,cls: 'container'
        ,items: [{
            html: '<h2>'+_('overthruster')+'</h2>'
            ,border: false
            ,cls: 'modx-page-header'
        },{
            xtype: 'modx-tabs'
            ,defaults: { border: false ,autoHeight: true }
            ,border: true
            ,activeItem: 0
            ,hideMode: 'offsets'
            ,items: [{
                title: _('overthruster.templates')
                ,items: [{
                    html: '<p>'+_('overthruster.intro_msg')+'</p>'
                    ,border: false
                    ,bodyCssClass: 'panel-desc'
                },{
                    xtype: 'overthruster-grid-templates'
                    ,preventRender: true
                    ,cls: 'main-wrapper'
                }]
            }]
        }]
    });
    overThruster.panel.Home.superclass.constructor.call(this,config);
};
Ext.extend(overThruster.panel.Home,MODx.Panel);
Ext.reg('overthruster-panel-home',overThruster.panel.Home);
