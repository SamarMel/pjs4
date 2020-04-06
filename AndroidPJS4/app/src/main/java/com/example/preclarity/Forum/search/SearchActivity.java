package com.example.preclarity.Forum.search;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.Button;
import android.widget.ListView;

import com.example.preclarity.Forum.AccueilForum;
import com.example.preclarity.Forum.Topic;
import com.example.preclarity.Forum.TopicAdapter;
import com.example.preclarity.Forum.TopicsBackgroundWorker;
import com.example.preclarity.MenuActivity;
import com.example.preclarity.R;
import com.example.preclarity.TopicActivity;

import java.util.List;
import java.util.concurrent.ExecutionException;

public class SearchActivity extends AppCompatActivity {
    ListView topics;
    Button menu;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_search);
        menu =(Button) findViewById(R.id.btnMenu);
        topics = (ListView) findViewById(R.id.listSearchForum);
        List<Topic> listetopics = getTopics();
        TopicAdapter adapter = new TopicAdapter(this, listetopics);
        topics.setAdapter(adapter);
        topics.setClickable(true);
        topics.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                Topic topic = (Topic) topics.getItemAtPosition(position);
                int idTopic = topic.getId();
                Intent intent = new Intent(SearchActivity.this, TopicActivity.class);
                intent.putExtra("idTopic", idTopic);
                SearchActivity.this.startActivity(intent);
                overridePendingTransition(R.anim.slide_in_right, R.anim.slide_out_left);
            }
        });

        menu = (Button) findViewById(R.id.btnMenu);
        menu.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(SearchActivity.this, MenuActivity.class));
                overridePendingTransition(R.anim.slide_in_right, R.anim.slide_out_left);
            }
        });
    }


    public List<Topic> getTopics(){

        SearchBackgroundWorker topicBw = new SearchBackgroundWorker();
        List<Topic> last =null;
        try{
            last=  topicBw.execute().get();
        }catch(InterruptedException | ExecutionException e){;}

        //aller chercher dans base de données les derniers topics
        return last;

    }
}
