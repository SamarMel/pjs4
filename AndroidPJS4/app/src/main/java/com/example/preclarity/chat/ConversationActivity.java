package com.example.preclarity.chat;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.Window;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.EditText;
import android.widget.FrameLayout;
import android.widget.LinearLayout;
import android.widget.ScrollView;
import android.widget.TextView;

import com.example.preclarity.MenuActivity;
import com.example.preclarity.R;

import java.util.ArrayList;
import java.util.List;
import java.util.Timer;
import java.util.TimerTask;
import java.util.concurrent.ExecutionException;

public class ConversationActivity extends AppCompatActivity {
    private static final String TAG = "CONVERSATION ACTIVITY";
    private TextView reponse;
    private EditText input;
    private Button btn_send;

    private LinearLayout chatLayout;
    private EditText queryEditText;
    private TextView friendPseudo;

    private Button menu;

    private static final int USER = 10001;
    private static final int FRIEND = 10002;
    private int idConv;

    private class Refresh extends TimerTask{
        //private ArrayList postRefreshList;
        private int idConv;
        private int myId;
        public Refresh(int c, int i){
           // postRefreshList=l;
            idConv = c;
            myId =i;
        }


        @Override
        public void run() {
          /*  ArrayList<Message> messages = null;
            ConversationBackgroundWorker convBw = new ConversationBackgroundWorker();
            try {
                messages = (ArrayList<Message>) convBw.execute(idConv).get();
            } catch (ExecutionException e) {
                e.printStackTrace();
            } catch (InterruptedException e) {
                e.printStackTrace();
            }
            if(messages.size()!= postRefreshList.size()){*/
                updateUI();
                dialog(idConv, myId);
            //}


        }
    }
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        requestWindowFeature(Window.FEATURE_NO_TITLE);
        this.getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN,WindowManager.LayoutParams.FLAG_FULLSCREEN);
        setContentView(R.layout.activity_conversation);

        //reponse = (TextView) findViewById(R.id.chatMsg);
        input = (EditText) findViewById(R.id.input);
        btn_send = (Button) findViewById(R.id.btn_send);
        chatLayout = (LinearLayout) findViewById(R.id.chatLayout);
        friendPseudo= (TextView) findViewById(R.id.friendName);
         menu = (Button) findViewById(R.id.btnMenu);
         menu.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(ConversationActivity.this, MenuActivity.class));
                overridePendingTransition(R.anim.slide_in_right, R.anim.slide_out_left);
            }
        });



        //placement de l'affichage en bas du scrollview
        final ScrollView scrollview = findViewById(R.id.chatScrollView);
        scrollview.post(() -> scrollview.fullScroll(ScrollView.FOCUS_DOWN));
        Context context = getApplicationContext();

        SharedPreferences sharedPref = context.getSharedPreferences("user",Context.MODE_PRIVATE);
        int idUser = sharedPref.getInt("id",-1);
        Bundle b = getIntent().getExtras();
        if (b != null) {
            idConv = b.getInt("idConv");
            String friend = b.getString("pseudo");
            friendPseudo.setText(friend);

            //chargement des anciens messages
            dialog(idConv,idUser);
            //refresh des anciens messages
           // Timer timer = new Timer();
            //Refresh task = new Refresh(idUser, idConv);
            //timer.schedule(task,6000,500000);



            btn_send.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    //enregistrement et affichage du nouveau message
                    newMessage(idConv,idUser);
                }
            });




        }


    }
    private void updateUI(){
        ConversationActivity.this.runOnUiThread(new Runnable() {
            @Override
            public void run() {
                chatLayout.removeAllViews();

            }
        });


    }

    private void newMessage(int idConv, int myId){
        String content = input.getText().toString();
        showTextView(content, USER);
        //enregistrement des nouveaux messages
        NewMessageBackgroundWorker newMessBw = new NewMessageBackgroundWorker();
        Boolean b = false;
        try{
             b= newMessBw.execute(String.valueOf(idConv),String.valueOf(myId), content).get();
        } catch (ExecutionException e) {
            e.printStackTrace();
        } catch (InterruptedException e) {
            e.printStackTrace();
        }
        if(b){
            Log.w(TAG, "MESSAGE ENREGISTRE DANS BD");
        }else{
            Log.w(TAG, "ECHEC ENREGISTREMENT DANS LA BD");
        }


    }

    private void dialog(int idConv, int myId) {
        //charger les anciens messages
        ArrayList<Message> messages = null;
        ConversationBackgroundWorker convBw = new ConversationBackgroundWorker();
        try {
            messages = (ArrayList<Message>) convBw.execute(idConv).get();
        } catch (ExecutionException e) {
            e.printStackTrace();
        } catch (InterruptedException e) {
            e.printStackTrace();
        }
        if(messages!=null){
            for(Message m : messages){
                if(m.getIdAuteur() == myId) showTextView(m.content, USER);
                else showTextView(m.content, FRIEND);
            }
        }



    }


    //ajout sur interface d'un message dans le chat
    private void showTextView(String message, int type) {
        FrameLayout layout;
        switch (type) {
            case USER:
                layout = getUserLayout();
                break;
            case FRIEND:
                layout = getFriendLayout();
                break;
            default:
                layout = getFriendLayout();
                break;
        }

        layout.setFocusableInTouchMode(true);
        chatLayout.addView(layout);
        TextView tv = layout.findViewById(R.id.chatMsg);
        tv.setText(message);
        layout.requestFocus();
        input.requestFocus();
    }


    //Récupéraction de l'interface graphique des messages
    public FrameLayout getUserLayout() {
        LayoutInflater inflater = LayoutInflater.from(ConversationActivity.this);
        return (FrameLayout) inflater.inflate(R.layout.user_msg_layout, null);
    }

    public FrameLayout getFriendLayout() {
        LayoutInflater inflater = LayoutInflater.from(ConversationActivity.this);
        return (FrameLayout) inflater.inflate(R.layout.friend_msg_layout, null);
    }
}
