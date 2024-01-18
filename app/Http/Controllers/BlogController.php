<?php

namespace App\Http\Controllers;

use Goutte\Client;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request) 
    {
    $client = new Client();
    $crawler = $client->request('GET', 'https://duckduckgo.com/html/?q=("'.$request->title.'")');
    $summaries = [];
    if($request->title){
        $summaries = $crawler->filter('.result__body')->each(function ($node) {
            return $node->filter('.result__snippet')->text();
        });
    }
    // $summary = '';
    // foreach ($summaries as $val) {
    //     $summary .= $val;
    // }
    // $client = new \GuzzleHttp\Client();
    // // dd($summary);
    // $response = $client->request('POST', 'https://chatgpt-chatgpt3-5-chatgpt4.p.rapidapi.com/v1/chat/completions', [
    //   'body' => '{
    //     "model": "gpt-3.5-turbo",
    //     "messages": [
    //         {
    //             "role": "user",
    //             "content": "generate a blog from these summaries mix with h2 headings and subheadings(1. Water the soil on planting day before you dig the hole. Give the planting location a good hose down to moisten the soil and make it easier to turn. Moist soil is also more hospitable and minimizes root stress for a newly transplanted tree. [9] 2. Dig a hole 2-3 times the diameter of the root ball.You can still plant after the first fall frosts but make sure the tree is in the ground when the soil gradually gets cooler and eventually freezes in the late fall/early winter. The second-best time to plant a tree is in the spring, the cooler the weather, the better. Spring planting gives the tree the entire growing season to get established.How to Dig a Hole for a Tree. First, prepare a hole two to three times as wide as the root ball of your tree. Dig down to about the depth of the root ball so that when it\'s resting on the bottom of the hole, the tree is at the same level with the ground as it was in its container. Handle the root ball carefully to keep it intact while you place ...Firm it down in stages by lighting treading over the soil - this will prevent any air pockets. Water in well - place a hosepipe over the hole and run it until the water runs over. 10. Mulch. Mulching is important to help provide the tree with nutrients and to help the soil retain water.How to plant a tree the right way - follow these seven important steps:-1. Prepare the proper planting hole. When preparing any hole for planting, make it three times wider than the current root mass but never deeper than the plant was growing in its previous environment.1. Dig a Hole 3 Inches Deeper Than the Length of the Roots. Tip: Choose a place that is shielded from the wind. If your planting site is exposed to the wind, use nearby objects (like a rock or stick) to create a windbreak. Plant on the north side of the windbreak for shade and wind protection.Get instructions based on the kind of tree you\'re going to plant. Look at the root configuration to determine the best planting process.Expose the trunk flare if necessary. 4. Place the tree at the proper height. When placing the tree in the hole, lift by the root ball, not the trunk. The majority of tree\'s roots develop in the top 12 inches (30 cm) of soil. Planting too deep can be harmful to the tree. 5. Straighten the tree in the hole.Drive a stake into the ground at that spot. Measure the diameter of the tree\'s root ball. Use a can of brightly colored spray paint to mark a circle around the stake that\'s two to three times wider in diameter than the root ball. Tip: Use special marking paint, which has a spray nozzle that works when the can is tilted upside down. Step 3.Step 1: Dig the planting hole. Photo: istockphoto.com. Dig a hole that is two to three times wider than the root ball of the tree you\'re planting. Make the hole the same depth as the root ball ...Insert a sturdy stake. Insert at a 45 degree angle, using a mallet to make sure it\'s deeply anchored. Then attach the trunk to the stake with a flexible tree tie. This will hold the base of the trunk and rootball steady, allowing the roots to get well established, while letting the upper part of the trunk flex and strengthen.Trees and shrubs add beauty to landscapes. Charlie shows you the steps for planting a deciduous tree or shrub and offers essential care tips to help your pla...Step 4: Place Your Tree in the Hole. Before removing the tree from its nursery container, set the potted tree inside the hole to make sure everything is looking good. After you plant the tree, the top of the root ball and base of the tree trunk should sit just slightly higher than ground level.Step 2. Remove the pot from container-grown trees and any wrapping from bare-root ones. Tease out and unwind any circling roots and cut off any damaged ones. This will encourage the roots to venture out into the soil. Stand the tree in the planting hole, then lay a cane across the hole to check that the top of the rootball - or the dark soil ...An effective way to control the moisture level in the original soil ball of a new tree is to use some form of drip irrigation. The simplest method is to use a 5-gallon plastic bucket. (See the figure above.) Drill 1/8-inch-diameter holes in the sides near the bottom, and place the bucket next to the tree.Dig the planting hole the same depth as the root ball but 2-3 times the width. Score the sides of the hole. Gently lift the tree using the burlap and lower it into the middle of the hole. The root flare—highest major root—should be level with the soil surface. Rock the tree gently to one side while tucking the burlap beneath the tree.Step 2: Dig a hole and plant your tree. Remove grass and weeds in a 4-foot wide area. Dig a wide, shallow hole 4 feet wide and only as deep as the rootball from the root flare to the bottommost roots. This height will vary from tree to tree. Score the sides of the planting hole with a shovel or pickaxe so the sides are not smooth.Whether you\'re wanting a peach tree or any other tree, this is how I plant a tree. Planting isn\'t complicated, but a few crucial steps ensure your tree will ...Ecosia is the search engine that plants trees: https://ecosia.co/info Planting a tree may seem like an easy thing to do. But we have learned in our ten years...Step 1: Dig the Planting Hole. Dig the hole for the tree. A good rule of thumb is to dig a hole that\'s twice the width of the container and just as deep. Loosen the soil at the bottom of the hole and on the sides. Loosening the soil makes it easier for the roots to embed themselves into the ground. It\'s a good idea to wet the entire hole to ...Today I show you how to plant a tree. Planting a tree is incredibly easy to do - it only takes a couple minutes - and you only need a few basic items. Don\'t ...Step-by-step planting guide: Step 1. Make sure the roots are submerged in a bucket of water for 2 hours before planting. Exposed roots don\'t do well - the root hairs dry easily and quickly die. Step 2. Dig a hole: it should be at least double the width of the root ball.)"
    //         }
    //     ],
    //     "temperature": 0.8
    // }',
    //   'headers' => [
    //     'X-RapidAPI-Host' => 'chatgpt-chatgpt3-5-chatgpt4.p.rapidapi.com',
    //     'X-RapidAPI-Key' => '19134f2b12msh515696babb2758dp1ccff8jsn8272ee676b32',
    //     'content-type' => 'application/json',
    //   ],
    // ]);
    
    // echo $response->getBody();
    
    
    return view('app')->with('summaries', $summaries);
    
}
    public function app() 
    {
        $summaries = [];
        return view('app')->with('summaries', $summaries);
        
    }
}
