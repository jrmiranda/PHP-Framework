<div class="row row-lg" ng-app='testApp' ng-controller="testCtrl">
    <div class="col-3-4" style="padding: 10px 5px 0 0;">
        <div class="box unbordered">
            <?php echo $this->lang->browser();?>
            {{ count }}
            <button ng-click='count = count + 1' class="button button-blue button-l">Testando</button>
        </div>
    </div>
    <div class="col-1-4" style="padding: 10px 0 0 5px;">
        <?php $this->load->module('/rightbar');?>
    </div>
</div>

<script>
var testApp = angular.module('testApp', []);

testApp.controller('testCtrl', function ($scope) {
    $scope.test = function() {alert('ok');};
});
</script>