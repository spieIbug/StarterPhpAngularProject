/**
 * Created by yacmed on 02/12/2015.
 */
var agentPage = null;
clippy.load('Merlin', function(agent) {
    // Do anything with the loaded agent
    agentPage = agent;
    agent.show();
});