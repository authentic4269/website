<?php

class WebChapterController extends WebBaseController {

  private function countBrothers() {
    $result = $this->mysqli->query("SELECT count(*) FROM brothers");
    $row = $result->fetch_row();
    return $row[0];
  }

  /**
   * Renders the inner content markup for the page.
   * @return string The inner content markup.
   */
  protected function renderContent() {
    $bcount = $this->countBrothers();

    $tabs = array(
      <div id="tab1" class="tab_content">
        <h2>Why Go Delt?</h2>
        <h3>Beta Omicron</h3>
        <p>On a cold Ithaca winter in 1889 Charles Dickinson gathered together
          11 other Cornell men and introduced them to the idea of a bond beyond
          friendship and comradory; that is, the bond of brotherhood. These
          twelve men then set out to find an organiztion to help them form their
          elusive brotherhood. Petitions were sent out to Delta Tau Delta
          fraternity as well as Sigma Chi fraternity. After one chapter
          initially rejected the Cornell men's request, a charter from Delta Tau
          Delta was finally granted to the twelve eager men. These first twelve
          Cornell Delts were initiated on January 17, 1890 and the Beta Omicron
          chapter of Delta Tau Delta was incoporated one week later. Shortly
          after, Dickinson was elected as Beta Omicron's first and still
          youngest President. After moving between several houses for a number
          of years, the Cornell Delts finally landed at 110 Edgemore Lane where
          they built a shelter which would last them for 71 years. During this
          time many famous Cornell Delts lived in the shelter, such as Willard
          Straight who worked and became a trusted advisor for J.P. Morgan.</p>
        <p>Also during this time Nelson Brayer became a "pillar" of the chapter
          by faithfully serving Beta Omicron for over 50 years and most
          importantly leading them financially through the tough years of the
          Great Depression. During World War II many Cornell Delts fought and
          died heroically for their country; in this period as well the Delts
          were forced to move out of their shelter so it could become an army
          barrack. Following World War II, Delts returning from the war adopted
          a more serious attitude and hazing was eliminated. In 1949, one of the
          most successful collegiate acapella groups was formed by Cornell Delt
          Jim Casey; this group came to be know as the Cayuga Waiters and their
          songs can still be heard echoing throughout Cornell. Due to old age
          the Delts were forced to give up there much loved shelter at 110
          Edgemore Lane and build a new shelter at our current site, 1 Campus
          Rd, which happened to be where Ezra Cornell (the founder of Cornell
          University) lived for twelve years. The Cornell Delts received the
          help of several alumni both in raising funds and designing the new
          shelter. The 1 Campus Rd. shelter was completed in November 1965 and
          has subsequently served our chapter soundly ever since. The Beta
          Omicron chapter has recently seen a resurgence in the pride and faith
          of its brotherhood, and the prospect of Hugh Shields award, something
          missing for many years now, is right on the horizon. Also won the
          eastern division outstanding recruitment/retention outstanding shelter
          cleanliness and maintenance award second year in a row.</p>
        <h3>Academics</h3>
        <p>Delta Tau Delta consistently ranks among the top of all Fraternities
          with regards to academics. For the last 5 years, Delta Tau Delta has
          found itself either at the top or near the top in terms of GPA.</p>
        <p>Our house GPA is currently a 3.362, the 9th highest on campus.</p>
        <h3>Values Based Organization</h3>
        <p>Delta Tau Delta is a value driven organization, and we strive to make
          all of our decisions based on our mission and values. Our members live
          by the principles of integrity, accountability, truth and courage.
          Building a fraternity around these values sets forth the expectations
          for how the fraternity will run and the behavior in the fraternity.
          Bringing these values into our Brotherhood allow for personal and
          organizational accountability and overall excellence.</p>
        <h3>Leadership Academy</h3>
        <p>The academy is a personal development process based on The 7 Habits
          of Highly Effective People by Stephen Covey. This process is not
          designed to create better presidents or recruitment chairman, but to
          offer our undergraduates the opportunity to assess their personal
          skills, strengths and weaknesses; so that they may better prepare
          themselves for their future. Recently added to our leadership
          development opportunities is an experimental process that takes place
          in the Rocky Mountains, and another on the North Atlantic off the
          coast of Maine. The purpose of this expedition is to provide the
          basics of outdoor leadership including basic communication and
          leadership skills.</p>
        <h3>Who is a Delt?</h3>
        <p>Join the ranks of thousands of Delts. Over 143,000 men have been
          initiated into Delta Tau Delta Fraternity. These men are doctors,
          lawyers, teachers, athletes, musicians, senators, businessmen,
          fathers, grandfathers, mentors, advisors, etc. Becoming a Delt offers
          you an instant connection between these men and you, a connection that
          could result in some phenomenal life experiences and advice.</p>
        <p>Not only are these men Delts, they also give back to their
          organization. Delta Tau Delta is the #1 Fraternity in terms of per
          member giving and has one of the largest Educational Foundations in
          the fraternity world. Alumni giving has endowed our leadership
          programming and is establishing the funds to keep us among the leaders
          in the fraternity world.</p>
        <h2>DTAA</h2>
        <p>As men committed to lives of excellence, Delta Tau Delta expects each
          of its members to respect his health and welfare, as well as that of
          his fellow brothers and community. The intent of &quot;Delts Talking
          About Alcohol&quot; is to share specific ways to reduce the risk of
          any type of alcohol-related problems.</p>
        <p>Alcohol is a significant issue in the lives of students in high
          school, college and throughout our adult lives. Whether you abstain
          from alcohol entirely or not, it is an influence in our lives and in
          the lives of our family and friends. Delta Tau Delta is pleased to
          provide Delts Talking About Alcohol: Powered by GreekLifeEdu as a
          component of our member education initiatives.</p>
      </div>,

      <div id="tab2" class="tab_content">
        <h2>Delt Housing Information</h2>
        <h3>Surroundings</h3>
        <p>Living in the fraternity house has a great impact on your life. You
          are constantly surrounded by the Brothers who have been through the
          same initiation you have. Which means you instantly have a unique bond
          that binds you together. Living with {$bcount - 1} of your close
          friends is definitely a unique experience. There is always something
          to do at the Delt house whether it&apos;s going to the gym, playing
          basketball or volleyball, or just relaxing about the house talking to
          your brothers.</p>
        <img id="delt_shelter" src="img/delt.jpeg" width="500px" />
        <h3>Delt Housing Facts</h3>
        <ul id="housing">
          <li class="txt">Home to {$bcount} brothers</li>
          <li class="txt">Every brother has their own bedroom</li>
          <li class="txt">Extra-Large Common Area for all brothers</li>
          <li class="txt">Shared kitchen, dining room, library, and laundry room</li>
          <li class="txt">2 - 50&quot; HD TVs</li>
          <li class="txt">Speaker system that blows clothes off</li>
          <li class="txt">802.11n WPA2 Enterprise Wifi</li>
          <li class="txt">Free parking</li>
          <li class="txt">New furniture, ping pong table, billiards table</li>
          <li class="txt">Completely renovated, state-of-the-art gym</li>
        </ul>
      </div>,

      <div id="tab3" class="tab_content">
        <h2>Fraternity History</h2>
        <p>Delta Tau Delta was founded in 1858 at Bethany College in present
          day West Virginia. Eight men, angered by a fixed vote for a prize in
          oratory to be given at the Neotrophian Literary Society (a forum for
          students to practice and demonstrate skills in poetry, public
          speaking and writing essays), responded by forming a secret society.
          The purpose of the new society, known only by the Greek letters
          Delta Tau Delta, was to see the Neotrophian Society returned to
          popular control from the Phi Kappa Psi Fraternity, and to form an
          organization of the student body drawn together by common aims,
          brotherly regard and desire for mutual support.</p>
        <p>Delta Tau Delta was born of the knowledge that integrity is
          essential. The founding principles of Truth, Courage, Faith and
          Power have provided a guide for both the Fraternity and its
          membership.</p>
        <p>Since 1858 the Fraternity has spread to nearly 200 campuses with
          over 120 active chapters and colonies comprised of about 6,500
          undergraduate members. For over 150 years, Delta Tau Delta has in
          excess of 150,000 men who have become members of the Fraternity.</p>
      </div>,

      <div id="tab4" class="tab_content">
        <h2>The John Hunt Scholarship</h2>
        <h3>Congratulations to our Fall 2010 Winner, Sadev Parikh!</h3>
        <h3>About the Scholarship</h3>
        <p>Delta Tau Delta International Fraternity was founded in 1858 by a
          group of eight men dedicated to six basic values.  John L. N. Hunt
          was the founder who most championed academic excellence, one of
          these core values.  After graduating, he would go on to serve as New
          York State&apos;s Commissioner of Education for several years.  This
          first annual John Hunt Scholarship will be awarded to the first-year
          man who most exemplifies Hunt&apos;s commitment to Lifelong Learning
          and Growth.</p>
        <h3>Eligibility:</h3>
        <p>Must have full-time first-year undergraduate status with Cornell
          University.  Applicants need not have interest in becoming a member
          of the Fraternity.</p>
        <h3>Deadline:</h3>
        <p>Applicants should postmark or return a completed application to
          Delta Tau Delta, at 104 Mary Ann Wood Drive, Ithaca, NY 14850, by
          Friday, October 30, 2010. </p>
        <h3>Prize:</h3>
        <p>First-place winner will receive an award of $250.</p>
      </div>,
    );

    $tab_container = <div class="tab_container" />;
    foreach ($tabs as $tab) {
      $tab_container->appendChild($tab);
    }

    return
      <div id="main">
        <div class="content_left pull-left">
          <h1 class="gold">Lifelong learning and growth are vital</h1>
          <ul class="tabs">
            <li><a href="#tab1">About Beta Omicron</a></li>
            <li><a href="#tab2">Shelter</a></li>
            <li><a href="#tab3">
              <span class="letters">&Delta;&Tau;&Delta;</span></a></li>
            <li><a href="#tab4">Scholarship</a></li>
          </ul>
          {$tab_container}
        </div>
        <div class="content_right pull-right">
          <a href="/recruitment" class="button">
            <strong class="txt">Sign Up Today!</strong><br />
            <small class="txt">Become a man of excellence</small>
          </a>
          <h2 class="gold">Helpful Links</h2>
          <ul>
            <li class="txt"><a href="http://www.delts.org">
              delts.org - National Web Site</a></li>
            <li class="txt"><a href="http://greeks.cornell.edu">
              greeks.cornell.edu - Cornell OFSA </a></li>
            </ul>
            <br /><br />
            <h3>"I would found an institution where any person can find
              instruction in any study." - Ezra Cornell, 1868</h3>
        </div>
      </div>;
  }

}
