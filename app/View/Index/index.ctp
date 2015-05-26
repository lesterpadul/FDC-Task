<div class="form">
      
      <!-- tabs -->
      <ul class="tab-group">
        <li class="tab"><a href="#signup">Sign Up</a></li>
        <li class="tab active"><a href="#login">Log In</a></li>
      </ul>
      <!-- /. -->
      
      <!-- label -->
      <div class="alert alert-info hidden" id="alertContainerIndex">
      
      </div>
      <!-- /. -->
      
      <!-- content -->
      <div class="tab-content">
        
        <!-- signup -->
        <div id="signup" style='display:none;'>   
          
          <form action="<?php echo $base_url.'users/register'; ?>" method="post" id='RegisterUserForm'>
            
            <div class="field-wrap form-group">
              <label>
                Name<span class="req">*</span>
              </label>
              <input type="text" required autocomplete="off" name='name_user'/>
            </div>
            
            <div class="field-wrap form-group">
              <label>
                Email Address<span class="req">*</span>
              </label>
              <input type="email"required autocomplete="off" name='email'/>
            </div>
            
            <div class="field-wrap form-group">
              <label>
                Set A Password<span class="req">*</span>
              </label>
              <input type="password"required autocomplete="off" name='password'/>
            </div>

            <div class="field-wrap form-group">
              <label>
                Re-type Password<span class="req">*</span>
              </label>
              <input type="password"required autocomplete="off" name='cpassword'/>
            </div>
            
            <button type="submit" class="button button-block" id='register_user_btn' >Get Started</button>
            
          </form>
        </div>
        <!-- /. -->
        
        <!-- login -->
        <div id="login" style='display:block;'>   
      
          <?php 
            echo $this->Form->create('User',array('controller'=>'Users','action'=>'login'));
          ?>
          
          <div class="field-wrap">
            <label>
             
            </label>
            <?php 
              echo $this->Form->input('email');
            ?>
          </div>
          
          <div class="field-wrap">
            <label>
            
            </label>
            <?php 
              echo $this->Form->input('password');
            ?>
          </div>
          
          <?php
            echo $this->Form->button('Log In',array('class'=>'button button-block','onclick'=>'LOGIN_USER(this);'));
            echo $this->Form->end();
          ?>
          
        </div>
        <!-- /. -->
        
      </div>
      <!-- /. -->
</div>