using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using System.Windows.Navigation;
using System.Windows.Shapes;
using MySql.Data.MySqlClient;

namespace gru_lokaverk
{
    /// <summary>
    /// Interaction logic for tab1.xaml
    /// </summary>
    public partial class tab1 : UserControl
    {
        sql database = new sql();

        Button[] btn_grid = new Button[128];
        int counter = 0;

        public tab1()
        {
            try
            {
                database.ConnectToDatabase();
            }
            catch (Exception e)
            {
                MessageBox.Show(e.ToString());
            }
            InitializeComponent();
            fillDataIntoGrid();
        }

        private void fillDataIntoGrid()
        {
            this.WeekPlan.ColumnDefinitions.Clear();
            this.WeekPlan.RowDefinitions.Clear();

            List<string> weekDays = new List<string>();
            List<string> time = new List<string>();
            string[] days = new string[8];
            try
            {
                weekDays = database.getDays();
                time = database.getTime();
                counter = 0;
                foreach (string item in weekDays)//Gets the weekdays from the database and puts them into an array.
                {
                    days[counter] = item;
                    counter++;
                }
                counter = 0;

                for (int j = 0; j < 8; j++)//Sets Columns
                {
                    this.WeekPlan.ColumnDefinitions.Add(new ColumnDefinition());

                    for (int i = 0; i < 15; i++)//Sets rows
                    {
                        string content = null;
                        btn_grid[counter] = new Button();
                        btn_grid[counter].Height = 29;
                        this.WeekPlan.RowDefinitions.Add(new RowDefinition() { Height = GridLength.Auto});



                        //Adds days to the week
                        if ((counter)%15==0 && counter>5)
                        {
                            content = days[j-1];
                        }
                        //Adds the time to the schedule
                        if (counter>0 && counter<15)
                        {
                            string[] tempArray = new string[5];
                            char split = ';';
                            tempArray = time[counter].Split(split);
                            content = tempArray[1] + " - " + tempArray[2];
                        }

                        btn_grid[counter].TabIndex = counter;
                        btn_grid[counter].Content = content;// +counter;//Adds number to the fields

                        Grid.SetRow(btn_grid[counter], i);
                        Grid.SetColumn(btn_grid[counter], j);

                        this.btn_grid[counter].Click += new RoutedEventHandler(tab1_Click);
                        this.WeekPlan.Children.Add(btn_grid[counter]);
                        counter++;
                    }
                }
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.ToString());
            }
        }

        void tab1_Click(object sender, RoutedEventArgs e)
        {
            
            Button tmpButton = (Button)sender;
            tmpButton.Background = Brushes.Blue;
            if (tmpButton.TabIndex==4)
            {
                tmpButton.Background = Brushes.Yellow;
                
            }
        }
    }
}
