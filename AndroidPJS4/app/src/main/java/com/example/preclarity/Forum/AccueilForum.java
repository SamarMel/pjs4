package com.example.preclarity.Forum;

import androidx.activity.OnBackPressedCallback;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.os.StrictMode;
import android.util.Log;
import android.view.View;
import android.view.Window;
import android.view.WindowManager;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.Spinner;

import com.example.preclarity.ListChatActivity;
import com.example.preclarity.MenuActivity;
import com.example.preclarity.R;
import com.example.preclarity.TopicActivity;
import com.example.preclarity.chat.ConversationActivity;

import java.util.List;
import java.util.concurrent.ExecutionException;

public class AccueilForum extends AppCompatActivity {
    private static final String TAG = "ACCUEIL FORUM";
    private ListView listeForum;
    private Button menu;
    String selectedCategory;
    private Button searchBtn;
    private EditText searchEt;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        requestWindowFeature(Window.FEATURE_NO_TITLE);
        this.getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN,WindowManager.LayoutParams.FLAG_FULLSCREEN);
        setContentView(R.layout.activity_accueil_forum);
        if (android.os.Build.VERSION.SDK_INT > 9)
        {
            StrictMode.ThreadPolicy policy = new
                    StrictMode.ThreadPolicy.Builder().permitAll().build();
            StrictMode.setThreadPolicy(policy);
        }
        searchEt = (EditText) findViewById(R.id.searchEt);
        selectedCategory="";
        searchBtn = (Button) findViewById(R.id.searchBtn);
        searchBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(selectedCategory.equals("")){
                    if(!searchBtn.equals("")){

                    }
                }

            }
        });

        //spinner
        Spinner spinner = (Spinner) findViewById(R.id.spinner_categories);
        ArrayAdapter<CharSequence> adapterCategories = ArrayAdapter.createFromResource(this,
                R.array.categories_array, android.R.layout.simple_spinner_item);
        adapterCategories.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        spinner.setAdapter(adapterCategories);
        selectedCategory="";
        spinner.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
                selectedCategory = parent.getItemAtPosition(position).toString();
            }

            @Override
            public void onNothingSelected(AdapterView<?> parent) {

            }
        });
        listeForum = (ListView) findViewById(R.id.listForum);
        List<Topic> lastTopics = getLastTopics();
        TopicAdapter adapter = new TopicAdapter(this, lastTopics);
        listeForum.setAdapter(adapter);
        listeForum.setClickable(true);
        listeForum.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                Topic topic = (Topic) listeForum.getItemAtPosition(position);
                int idTopic = topic.getId();
                Log.w(TAG, String.valueOf(idTopic));
                Intent intent = new Intent(AccueilForum.this, TopicActivity.class);
                intent.putExtra("idTopic", idTopic);
                AccueilForum.this.startActivity(intent);
                overridePendingTransition(R.anim.slide_in_right, R.anim.slide_out_left);
            }
        });

        menu = (Button) findViewById(R.id.btnMenu);
        menu.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(AccueilForum.this, MenuActivity.class));
                overridePendingTransition(R.anim.slide_in_right, R.anim.slide_out_left);
            }
        });

        OnBackPressedCallback callback = new OnBackPressedCallback(true) {
            @Override
            public void handleOnBackPressed() {
                startActivity(new Intent(AccueilForum.this, MenuActivity.class));
            }
        };


    }

    public List<Topic> getLastTopics(){

        TopicsBackgroundWorker topicBw = new TopicsBackgroundWorker(this);
        List<Topic> last =null;
        try{
             last=  topicBw.execute().get();
        }catch(InterruptedException | ExecutionException e){Log.w(TAG, "IterruptedException");}

        //aller chercher dans base de données les derniers topics
        Log.w(TAG,String.valueOf(last.size()));
        return last;

    }


}
