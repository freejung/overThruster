var overThruster = function(config) {
    config = config || {};
    overThruster.superclass.constructor.call(this,config);
};
Ext.extend(overThruster,Ext.Component,{
    page:{},window:{},grid:{},tree:{},panel:{},combo:{},config: {},view: {}
});
Ext.reg('overthruster',overThruster);

overThruster = new overThruster();